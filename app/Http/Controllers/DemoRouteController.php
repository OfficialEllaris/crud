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
        $items = session("items", []);

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
        ]);

        return redirect()->route('create-item')->with('feedback', 'Item added!');
    }

    /**
     * Show the form to update an existing item by its ID.
     *
     * @param  mixed  $id  The ID of the item to update
     * @return \Illuminate\View\View
     */
    public function updateItem($id)
    {
        return view('demo-route.update-item', ['id' => $id]);
    }

    /**
     * Delete an item by its ID.
     *
     * @param  mixed  $id  The ID of the item to delete
     * @return string
     */
    public function deleteItem($id)
    {
        return "Item deleted: $id";
    }
}