<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoRouteController extends Controller
{
    public function showItems()
    {
        $title = "Table of Items";

        return view('demo-route.show-items', [
            'title' => $title
        ]);
    }

    public function createItem()
    {
        return view('demo-route.create-item');
    }

    public function updateItem($id)
    {
        return view('demo-route.update-item', ['id' => $id]);
    }

    public function deleteItem($id)
    {
        return "Item deleted: $id";
    }
}
