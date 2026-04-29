<x-demo-layout :title="$title">
    <div class="flex flex-col gap-4">

        {{-- Feedback flash message --}}
        @if(session('feedback'))
            <div role="alert" class="alert alert-success alert-soft">
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
                        <input type="checkbox">
                        <span class="text-[10px]">{{ $item['name'] }}</span>
                    </div>

                    {{-- Remove item button --}}
                    <button>
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>

                </div>

            @endforeach
        @else

            {{-- Empty state --}}
            <div class="flex items-center justify-between border border-gray-500 px-4 py-2 rounded-lg">
                No items found!
            </div>

        @endif

        {{-- Remaining todos count --}}
        <em class="text-sm font-semibold">Your remaining todos: 3</em>

        {{-- Navigation link --}}
        <a href="{{ route('show-items') }}" class="link text-sm">GoTo Homepage</a>

    </div>
</x-demo-layout>