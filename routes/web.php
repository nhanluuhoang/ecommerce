<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AttachmentsController;
use App\Http\Controllers\WEB\HomeController;
use App\Http\Controllers\WEB\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('assets/{path}', [AttachmentsController::class, 'show'])->where('path', '.*');


Route::get('', [HomeController::class, 'index']);
Route::get('/{slug}', [PageController::class, 'index']);

Route::get('/san-pham', [ProductController::class, 'index']);
Route::get('/san-pham/{slug}', [ProductController::class, 'show']);
Route::get('/{category-slug}/{product-slug}', [ProductController::class, 'productOfCategory']);

Route::get('/ho-tro/chinh-sach-doi-tra', [PageController::class, 'returnPolicy']);
Route::get('/ho-tro/dieu-khoan-mua-ban', [PageController::class, 'termsOfSale']);
Route::get('/ho-tro/chinh-sach-giao-hang', [PageController::class, 'deliveryPolicy']);
Route::get('/ho-tro/phuong-thuc-thanh-toan', [PageController::class, 'paymentMethods']);
Route::get('/ho-tro/chinh-sach-bao-mat-thong-tin', [PageController::class, 'informationPrivacyPolicy']);
Route::get('/ho-tro/he-thong-cua-hang', [PageController::class, 'storeSystem']);

