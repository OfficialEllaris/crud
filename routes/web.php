<?php

use App\Http\Controllers\DemoRouteController;
use Illuminate\Support\Facades\Route;

Route::get('/demo-route', [DemoRouteController::class, 'showItems']);

Route::get('/demo-route/create-item', [DemoRouteController::class, 'createItem']);

Route::get('/demo-route/update-item/{id}', [DemoRouteController::class, 'updateItem']);

Route::get('/demo-route/delete-item/{id}', [DemoRouteController::class, 'deleteItem']);