<?php

use App\Http\Controllers\DemoRouteController;
use Illuminate\Support\Facades\Route;

/**
 * Display a list of all items.
 * 
 * @route GET /demo-route
 */
Route::get('/demo-route', [DemoRouteController::class, 'showItems'])->name('show-items');

/**
 * Show the form to create a new item.
 * 
 * @route GET /demo-route/create-item
 */
Route::get('/demo-route/create-item', [DemoRouteController::class, 'createItem'])->name('create-item');

/**
 * Store a newly created item in the session.
 * 
 * @route POST /demo-route/store-item
 */
Route::post('/demo-route/store-item', [DemoRouteController::class, 'storeItem'])->name('store-item');

/**
 * Show the form to update an existing item.
 * 
 * @route PATCH /demo-route/update-item
 * @param Request $request The request object containing the ID and status of the item to update
 */
Route::patch('/demo-route/update-item', [DemoRouteController::class, 'updateItem'])->name('update-item');

/**
 * Delete an item by its ID.
 * 
 * @route DELETE /demo-route/delete-item
 * @param Request $request The request object containing the ID of the item to delete
 */
Route::delete('/demo-route/delete-item', [DemoRouteController::class, 'deleteItem'])->name('delete-item');