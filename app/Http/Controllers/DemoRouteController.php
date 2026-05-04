<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DemoRouteController extends Controller
{
    /**
     * Display a list of all items stored in the session.
     *
     * @return \Illuminate\View\View
     */
    public function showItems()
    {
        $title = "Table of Items";

        return view('demo-route.show-items', [
            'title' => $title
        ]);
    }

    /**
     * Show the form to create a new item.
     * Retrieves existing items from the session to display alongside the form.
     *
     * @return \Illuminate\View\View
     */
    public function createItem()
    {
        $title = "Create Item";
        $items = collect(Session::get("items"));

        return view('demo-route.create-item', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Validate and store a new item in the session.
     * Redirects back to the create form with a feedback flash message on success.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(Request $request)
    {
        $request->validate([
            'taskName' => 'required|string|max:255',
        ]);

        Session::push('items', [
            'id' => uniqid(),
            'name' => $request->input('taskName'),
            'status' => 'pending',
        ]);

        return redirect()->route('create-item')->with('feedback', 'Item added!');
    }

    /**
     * Show the form to update an existing item by its ID.
     *
     * @param Request $request The request object containing the ID and status of the item to update
     */
    public function updateItem(Request $request)
    {
        $items = session('items', []);

        $targetItem = collect($items)->search(fn($item) => $item['id'] === $request->input('id'));

        if ($targetItem !== false) {
            $items[$targetItem]['status'] = $items[$targetItem]['status'] === 'completed' ? 'pending' : 'completed';
        }

        Session::put('items', $items);

        return redirect()->route('create-item')->with('feedback', 'Item updated!');
    }

    /**
     * Delete an item by its ID.
     *
     * @param Request $request The request object containing the ID of the item to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteItem(Request $request)
    {
        $items = collect(session('items', []));

        $filtered = $items->reject(fn($item) => $item['id'] === $request->input('id'));

        Session::put('items', $filtered->values()->all());

        return redirect()->route('create-item')->with('feedback', 'Item deleted!');
    }
}