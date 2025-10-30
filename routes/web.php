<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account;
use App\Http\Controllers\Home;
use App\Http\Controllers\Chat;
use App\Http\Controllers\ChatHistory;
use App\Http\Controllers\Store;
use App\Http\Controllers\History;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\Cart;
use App\Http\Controllers\StoreManagement;
use App\Http\Controllers\ProductUpdate;
use App\Http\Controllers\CreateStore;
use App\Http\Controllers\Search;

Route::get('/', [Home::class, 'guest'])->name('guest'); 
Route::get('/learnmore', [Home::class, 'learnMore'])->name('learnmore.view');


Route::get('/login', [Account::class, 'index'])->name('login.view'); 
Route::post('/login', [Account::class, 'login'])->name('login.post'); 

Route::get('/logout', [Logout::class, 'logout'])->name('logout.view');

Route::get('/registration', [Account::class, 'showRegistration'])->name('register.view'); 
Route::post('/registration', [Account::class, 'register'])->name('register.submit'); 

Route::get('/home', [Home::class, 'index'])->name('home.view');
Route::get('/search', [Search::class, 'search'])->name('search');

Route::get('/chathistory', [ChatHistory::class, 'index'])->name('chat.history');

Route::get('/history', [History::class, 'index'])->name('history.view');
Route::post('/history/rate', [History::class, 'submitReview'])->name('history.rate');

Route::get('/category/{category_id}', [Home::class, 'openCategory'])->name('category.view');

Route::get('/store/{store_id}', [Store::class, 'index'])->name('store.view');
Route::get('/store/{store_id}/reviews', [Store::class, 'allReviews'])->name('store.allReviews');

Route::post('/cart/add', [Cart::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [Cart::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/clear', [Cart::class, 'clear'])->name('cart.clear');

Route::get('/chat/{receiver_id}', [Chat::class, 'index'])->name('chat.view');
Route::post('/chat/{receiver_id}', [Chat::class, 'sendMessage'])->name('chat.send');

Route::get('/profile', [Profile::class, 'show'])->name('profile.show');
Route::put('/profile', [Profile::class, 'update'])->name('profile.update');

Route::get('admin/login', [Admin::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [Admin::class, 'login'])->name('admin.login.submit');
Route::get('admin/logout', [Admin::class, 'logout'])->name('admin.logout');

Route::get('admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
Route::post('admin/dashboard/action', [AdminDashboard::class, 'processAction'])->name('admin.dashboard.action');

Route::get('/store-create', [CreateStore::class, 'showForm'])->name('store.create.form');
Route::post('/store-create', [CreateStore::class, 'createStore'])->name('store.create');

Route::get('/store-management', [StoreManagement::class, 'index'])->name('store.management');
Route::post('/store-management/update-store', [StoreManagement::class, 'updateStore'])->name('store.update');
Route::post('/store-management/add-product', [StoreManagement::class, 'addProduct'])->name('product.add');
Route::post('/store-management/update-transaction', [StoreManagement::class, 'updateTransaction'])->name('transaction.update');

Route::get('/transaction', [Transaction::class, 'showTransactionPage'])->name('transaction.view');
Route::post('/transaction/process', [Transaction::class, 'processTransaction'])->name('transaction.process');
Route::get('/transaction/success/{transactionId}', [Transaction::class, 'showTransactionSuccess'])->name('transaction.success');

Route::get('/products/{product_id}/edit', [ProductUpdate::class, 'edit'])->name('product.edit');
Route::put('/products/{product_id}', [ProductUpdate::class, 'update'])->name('product.update');
Route::delete('/products/{product_id}', [ProductUpdate::class, 'delete'])->name('product.delete');