<x-demo-layout :title="$title">
    <div class="flex flex-col gap-4">

        {{-- Feedback flash message --}}
        @if(session('feedback'))
            <div role="alert" class="alert alert-success alert-soft" id="feedback">
                <span>{{ session('feedback') }}</span>
            </div>
        @endif

        {{-- Add new task form --}}
        <form method="POST" action="{{ route('store-item') }}" class="flex flex-col items-center gap-1">
            @csrf

            {{-- Task input and submit button --}}
            <div class="w-full flex items-center gap-4">
                <input type="text" class="border-0 border-b w-full focus:outline-none placeholder:text-[12px] ps-2 pb-1"
                    name="taskName" placeholder="Add new task">
                <button class="rounded-lg btn btn-sm btn-square cus--bg-primary text-white">
                    <i data-lucide="plus"></i>
                </button>
            </div>

            {{-- Validation error for task name --}}
            @error('taskName')
                <span class="w-full text-[10px] text-red-500 text-start">{{ $message }}</span>
            @enderror

        </form>

        {{-- Items list --}}
        @if ($items && !empty($items))
            @foreach ($items as $item)

                {{-- Single item row --}}
                <div class="flex items-center justify-between border border-gray-500 px-4 py-2 rounded-lg">

                    {{-- Checkbox and item name --}}
                    <div class="flex items-center gap-2">
                        <form action="{{ route('update-item') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="checkbox" {{ $item['status'] === 'completed' ? 'checked' : '' }} onchange="this.form.submit();">
                        </form>

                        <span
                            class="text-[10px] {{ $item['status'] === 'completed' ? 'line-through' : '' }}">{{ $item['name'] }}</span>
                    </div>

                    <form action="{{ route('delete-item') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        {{-- Remove item button --}}
                        <button type="submit" class="btn btn-sm btn-square cus--bg-primary text-white">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </form>

                </div>

            @endforeach
        @else

            {{-- Empty state --}}
            <div class="flex items-center justify-between border border-gray-500 px-4 py-2 rounded-lg">
                No items found!
            </div>

        @endif

        {{-- Remaining todos count --}}

        @php
        $remainingItems = $items->where('status', 'pending')->count()
        @endphp

        <em class="text-sm font-semibold">Your remaining todos: {{ $remainingItems }}</em>

        {{-- Navigation link --}}
        <a href="{{ route('show-items') }}" class="link text-sm">GoTo Homepage</a>

    </div>
</x-demo-layout>