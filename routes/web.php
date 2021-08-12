<?php

use App\Models\Rule;
use App\Models\SubCategory;
use App\Models\MessageBoard;
use Illuminate\Support\Facades\Route;

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

//Webhook Route
//Route::webhooks('webhook-receiving-url');

// RouteGroup for the Admin
Route::group(['prefix' => 'admin'], function (){
    Route::get('', 'Auth\AdminAuthController@index');
    Route::get('/login', 'Auth\AdminAuthController@login')->name('admin.login');
    Route::post('/login', 'Auth\AdminAuthController@authenticate')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminAuthController@logout')->name('admin.logout');

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    //Ticket Routes
    Route::get('tickets', 'Admin\TicketController@index')->name('admin.tickets');
    Route::get('ticket/all', 'Admin\TicketController@fetchAllTickets');
    Route::get('ticket/{id}', 'Admin\TicketController@fetchTicketByID');
    Route::get('ticket/delete/{id}', 'Admin\TicketController@deleteTicket');
    Route::post('ticket/store/reply', 'Admin\TicketController@storeReply');

    //Admins Accounts
    Route::get('admin/accounts/index', 'Admin\AdminController@index')->name('admin.admin-account');
    Route::get('admin/account/edit/{admin_id}', 'Admin\AdminController@editAdminAccount');
    Route::post('admin/account/update/{admin_id}', 'Admin\AdminController@updateAdminAccount');
    Route::get('admin/account/delete/{admin_id}', 'Admin\AdminController@deleteAdminAccount');
    Route::get('admin/accounts/all', 'Admin\AdminController@getAdminAccounts');
    Route::post('admin/account/create', 'Admin\AdminController@createAdminAccount');

    //User Accounts
    Route::get('user/accounts/index', 'Admin\UserController@index')->name('admin.user-account');
    Route::get('user/account/edit/{user_id}', 'Admin\UserController@editUserAccount');
    Route::post('user/account/update/{user_id}', 'Admin\UserController@updateUserAccount');
    Route::get('user/account/delete/{user_id}', 'Admin\UserController@deleteUserAccount');
    Route::get('user/accounts/all', 'Admin\UserController@getUserAccounts');
    Route::post('user/account/create', 'Admin\UserController@createUserAccount');

    // Orders Routes
    Route::get('orders/index', 'Admin\OrderController@index')->name('admin.orders');
    Route::get('order/all', 'Admin\OrderController@getAllOrders');
    Route::get('order/profit', 'Admin\OrderController@getOrderProfit');

    // Messages Routes
    Route::get('messages', 'Admin\MessageBoardController@index')->name('admin.message-board');
    Route::post('message/create', 'Admin\MessageBoardController@createMessage');
    Route::get('message/view/{id}', 'Admin\MessageBoardController@viewMessage');
    Route::get('message/edit/{id}', 'Admin\MessageBoardController@editMessage');
    Route::post('message/update/{id}', 'Admin\MessageBoardController@updateMessage');
    Route::get('message/delete/{id}', 'Admin\MessageBoardController@deleteMessage');

    // Messages Routes
    Route::get('rules', 'Admin\RuleController@index')->name('admin.rules');
    Route::get('rule/all', 'Admin\RuleController@getRules');
    Route::post('rule/create', 'Admin\RuleController@createRule');
    Route::get('rule/view/{id}', 'Admin\RuleController@viewRule');
    Route::get('rule/edit/{id}', 'Admin\RuleController@editRule');
    Route::post('rule/update/{id}', 'Admin\RuleController@updateRule');
    Route::get('rule/delete/{id}', 'Admin\RuleController@deleteRule');

    //Product Sub Category route
    Route::get('subcategory/home', 'Admin\CategoryController@index')->name('admin.subcategories');
    Route::get('sub-categories', 'Admin\CategoryController@subCategories');
    Route::get('sub-categories/{id}', 'Admin\CategoryController@subCategoriesByID');
    Route::get('sub-category/edit/{id}', 'Admin\CategoryController@editSubCategory');
    Route::post('sub-category/update/{id}', 'Admin\CategoryController@updateSubCategory');
    Route::get('sub-category/delete/{id}', 'Admin\CategoryController@deleteSubCategory');
    Route::post('sub-category/add', 'Admin\CategoryController@addSubCategory');

    //Product Category route
    Route::get('categories', 'Admin\CategoryController@categories')->name('admin.categories');
    Route::get('category/edit/{id}', 'Admin\CategoryController@editCategory');
    Route::post('category/update/{id}', 'Admin\CategoryController@updateCategory');
    Route::get('category/delete/{id}', 'Admin\CategoryController@deleteCategory');
    Route::post('category/add', 'Admin\CategoryController@storeCategory');

    //Main Category, SubCategories, Products
    Route::get('products/{id}', 'Admin\ProductController@index')->name('admin.products');
    Route::get('products/by-subcategory/{id}', 'Admin\ProductController@fetchProductBySubCategory');
    Route::get('products/view/{id}', 'Admin\ProductController@viewProduct');
    Route::post('product/store', 'Admin\ProductController@storeProduct');
    Route::get('product/edit/{product_id}', 'Admin\ProductController@editProduct');
    Route::post('product/update/{product_id}', 'Admin\ProductController@updateProduct');
    Route::get('product/delete/{product_id}', 'Admin\ProductController@deleteProduct');

    //Purchases
    Route::get('purchase/index', 'Admin\PurchaseController@index')->name('admin.purchases');
    Route::get('purchases', 'Admin\PurchaseController@allPurchases');
    Route::get('purchase/delete/{id}', 'Admin\PurchaseController@deletePurchase');
});



Route::group(['middleware'=>['setlocale']], function(){

    //User Authentication and User Registration Route
    Route::get('/', 'Auth\UserAuthController@index');
    Route::get('/login', 'Auth\UserAuthController@login')->name('login');
    Route::post('/login', 'Auth\UserAuthController@authenticate')->name('login.submit');
    Route::get('/register', 'Auth\UserAuthController@create')->name('create');
    Route::post('/register', 'Auth\UserAuthController@store')->name('store');
    Route::get('/logout', 'Auth\UserAuthController@logout')->name('logout');

    //User Home (Dashboard)
    Route::get('/home', 'User\HomeController@index')->name('home');
    Route::get('/home/profile', 'User\UserController@profile')->name('profile');
    Route::post('/home/profile/change-password', 'User\UserController@changePassword')->name('change.password');

    // Products
    Route::get('products/{id}', 'User\ProductController@products')->name('products')->middleware('lowfunds');
    Route::get('product/sub-category/{id}', 'User\ProductController@productBySubCategoryID')->middleware('lowfunds');

    // Credit Cards Routes
    Route::get('/cards', 'User\CardController@index')->name('cards');

    // Ticket and Ticket Reply Routes
    Route::get('/tickets', 'User\TicketController@index')->name('tickets');
    Route::post('/ticket/open-ticket', 'User\TicketController@openTicket')->name('open.ticket');
    Route::get('/ticket/view-ticket-reply/{ticket_id}', 'User\TicketController@viewTicketReply');
    Route::get('/ticket/delete-ticket/{ticket_id}', 'User\TicketController@deleteTicket');

    //Rules Route
    Route::get('/rules', function(){
        $rules = Rule::all();
        $title = 'Read Rules';
        return view('user.rules')->with(['title' => $title, 'rules' => $rules]);
    })->name('rules');


    //Wallet and Payment Processing Routes
    Route::get('/add-money', 'Payment\WalletController@addMoney')->name('add.money');
    Route::post('/deposit', 'Payment\WalletController@deposit')->name('deposit');
    Route::get('/deposit/complete', 'Payment\WalletController@depositComplete')->name('deposit.complete');
    Route::get('/deposit/canceled', 'Payment\WalletController@depositCancel')->name('deposit.cancel');

    //Cart Functionality Routes
    Route::get('cart-page', 'Payment\WalletController@cartPage')->name('cart');
    Route::get('cart/process-order', 'Payment\WalletController@processOrder')->name('process.order');
    Route::get('cart/thank-you', 'Payment\WalletController@thankYou')->name('thank.you');
    Route::get('cart/{id}', 'Payment\WalletController@cart');
    Route::get('cart/count/orderItems', 'Payment\WalletController@countOrderItems');
    Route::get('cart/delete-order-item/{id}', 'Payment\WalletController@deleteOrderItem');

    //Cart Functionality Routes
    Route::get('purchases', 'User\PurchaseController@index')->name('purchases');
    Route::get('purchase/all', 'User\PurchaseController@getPurchasesByUser');
    Route::get('purchase/view/{id}', 'User\PurchaseController@getPurchaseDetailsByUser');
    Route::get('purchase/delete/{id}', 'User\PurchaseController@deletePurchaseByUser');

    //MessageBoard Route
    Route::get('message/{id}', function($id){
        $message = MessageBoard::find($id);
        return response()->json(['message' => $message]);
    });
});
