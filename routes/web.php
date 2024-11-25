<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\HousekeepingController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WebsitePagesController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\PublicController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'install'], function() {
	Route::get('/', ['uses' => 'InstallController@index'])->name('checklist');
	Route::get('set-database', ['uses' => 'InstallController@databaseView'])->name('set-database');
	Route::post('save-database', ['uses' => 'InstallController@databaseSave'])->name('save-database');
	
	Route::get('set-siteconfig', ['uses' => 'InstallController@siteconfigView'])->name('set-siteconfig');
	Route::post('save-siteconfig', ['uses' => 'InstallController@siteconfigSave'])->name('save-siteconfig');
	
	Route::get('done', ['uses' => 'InstallController@doneView'])->name('done');
});

//front routes
Route::controller(UserController::class)->group(function () {
    Route::get('logout','logout')->name('user-logout');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('sign-in', 'signIn')->name('sign-in');
    Route::post('do-sign-in', 'doSignIn')->name('do-sign-in');
    Route::get('sign-up', 'signUp')->name('sign-up');
    Route::post('do-sign-up', 'doSignUp')->name('do-sign-up');

    Route::get('/', 'index')->name('home');
    Route::get('/room-details/{id}', 'roomDetails')->name('room-details');
    Route::get('advance-slip/{id}', 'advanceRoomSlip')->name('advance-slip');
    Route::get('contact-us', 'contactUs')->name('contact-us');
    Route::post('save-contact-message', 'contactUsMessage')->name('save-contact-message');
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::post('terms-conditions', 'termsConditions')->name('terms-conditions');
    Route::post('subscribe-notifivations', 'subscribeNotifications')->name('subscribe-notifivations');
    Route::get('search-rooms', 'searchRooms')->name('search-rooms');
});

//user routes
Route::prefix('user')->middleware(['isCustomer'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('user-dashboard', 'dashboard')->name('user-dashboard');
        Route::post('book-rooms', 'bookRooms')->name('book-rooms');

        Route::get('profile-details', 'profileDetails')->name('user-profile');
        Route::post('update-profile-details', 'updateProfileDetails')->name('update-profile-details');

        Route::get('change-password', 'changePassword')->name('change-password');
        Route::post('update-password', 'updatePassword')->name('update-password');
    });
});


//admin routes
Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'adminLogin')->name('login');
        Route::post('do-login', 'doLogin')->name('do-login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::middleware(['auth','permission','userlogs'])->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('dashboard', 'index')->name('dashboard');

            Route::get('profile', 'editLoggedUserProfile')->name('profile');
            Route::post('save-profile', 'saveProfile')->name('save-profile');
            Route::get('add-user', 'addUser')->name('add-user');
            Route::get('edit-user/{id}', 'editUser')->name('edit-user');
            Route::post('save-user', 'saveUser')->name('save-user');
            Route::get('list-user', 'listUser')->name('list-user');
            Route::get('delete-user/{id}', 'deleteUser')->name('delete-user');

            Route::get('add-room', 'addRoom')->name('add-room');
            Route::get('edit-room/{id}', 'editRoom')->name('edit-room');
            Route::post('save-room', 'saveRoom')->name('save-room');
            Route::get('list-room', 'listRoom')->name('list-room');
            Route::get('delete-room/{id}', 'deleteRoom')->name('delete-room');

            Route::get('add-room-types', 'addRoomType')->name('add-room-types');
            Route::get('edit-room-types/{id}', 'editRoomType')->name('edit-room-types');
            Route::post('save-room-types', 'saveRoomType')->name('save-room-types');
            Route::get('list-room-types', 'listRoomType')->name('list-room-types');
            Route::get('delete-room-types/{id}', 'deleteRoomType')->name('delete-room-types');
            Route::get('view-room-type/{id}', 'viewRoomType')->name('view-room-type');
            Route::get('price-rules/{id}', 'priceRuleRoomType')->name('room-types-price-rule');
            Route::post('save-price-rules', 'savePriceRuleRoomType')->name('save-room-types-price-rule');

            Route::get('add-amenities', 'addAmenities')->name('add-amenities');
            Route::get('edit-amenities/{id}', 'editAmenities')->name('edit-amenities');
            Route::post('save-amenities', 'saveAmenities')->name('save-amenities');
            Route::get('list-amenities', 'listAmenities')->name('list-amenities');
            Route::get('delete-amenities/{id}', 'deleteAmenities')->name('delete-amenities');

            Route::get('quick-check-in/{step}', 'roomReservation')->name('quick-check-in');
            Route::get('check-in/{step}', 'roomReservation')->name('room-reservation');
            Route::post('save-reservation', 'saveReservation')->name('save-reservation');
            Route::get('check-out/{id}', 'checkOut')->name('check-out-room');
            Route::post('check-out', 'saveCheckOutData')->name('check-out');
            Route::get('list-check-ins', 'listReservation')->name('list-reservation');
            Route::get('list-check-outs', 'listCheckOuts')->name('list-check-outs');
            Route::get('list-cancelled-reservations', 'listCancelledReservations')->name('list-cancelled-reservations');
            Route::get('edit-reservation_/{id}', 'editReservation')->name('edit-reservation_');
            Route::get('view-reservation/{id}', 'viewReservation')->name('view-reservation');
            Route::get('cancel-reservation/{id}', 'cancelReservation')->name('cancel-reservation');
            Route::get('delete-reservation/{id}', 'deleteReservation')->name('delete-reservation');
            Route::get('invoice/{id}/{type}/{inv_type?}', 'invoice')->name('invoice');
            Route::post('advance-pay', 'advancePay')->name('advance-pay');
            Route::get('swap-room/{id}', 'swapRoom')->name('swap-room');
            Route::post('save-swap-room', 'saveSwapRoom')->name('save-swap-room');
            Route::get('delete-mediafile/{id}', 'deleteMediaFile')->name('delete-mediafile');
            Route::get('mark-as-paid/{id}', 'markAsPaid')->name('mark-as-paid');

            Route::get('add-food-category', 'addFoodCategory')->name('add-food-category');
            Route::get('edit-food-category/{id}', 'editFoodCategory')->name('edit-food-category');
            Route::post('save-food-category', 'saveFoodCategory')->name('save-food-category');
            Route::get('list-food-category', 'listFoodCategory')->name('list-food-category');
            Route::get('delete-food-category/{id}', 'deleteFoodCategory')->name('delete-food-category');

            Route::get('add-food-item', 'addFoodItem')->name('add-food-item');
            Route::get('edit-food-item/{id}', 'editFoodItem')->name('edit-food-item');
            Route::post('save-food-item', 'saveFoodItem')->name('save-food-item');
            Route::get('list-food-item', 'listFoodItem')->name('list-food-item');
            Route::get('delete-food-item/{id}', 'deleteFoodItem')->name('delete-food-item');

            Route::get('add-expense-category', 'addExpenseCategory')->name('add-expense-category');
            Route::get('edit-expense-category/{id}', 'editExpenseCategory')->name('edit-expense-category');
            Route::post('save-expense-category', 'saveExpenseCategory')->name('save-expense-category');
            Route::get('list-expense-category', 'listExpenseCategory')->name('list-expense-category');
            Route::get('delete-expense-category/{id}', 'deleteExpenseCategory')->name('delete-expense-category');

            Route::get('add-expense', 'addExpense')->name('add-expense');
            Route::get('edit-expense/{id}', 'editExpense')->name('edit-expense');
            Route::post('save-expense', 'saveExpense')->name('save-expense');
            Route::get('list-expense', 'listExpense')->name('list-expense');
            Route::get('delete-expense/{id}', 'deleteExpense')->name('delete-expense');

            Route::get('food-order/{reservation_id?}', 'FoodOrder')->name('food-order');
            Route::get('food-order-table/{order_id}', 'FoodOrderTable')->name('food-order-table');
            Route::get('food-order-final/{order_id}', 'FoodOrderFinal')->name('food-order-final');
            Route::post('save-food-order', 'saveFoodOrder')->name('save-food-order');

            Route::get('orders-list', 'listOrders')->name('orders-list');
            Route::get('order-invoice/{id}', 'orderInvoice')->name('order-invoice');
            Route::get('order-invoice-final/{order_id}', 'orderInvoiceFinal')->name('order-invoice-final');
            Route::get('kitchen-invoice/{order_id}/{order_type}', 'kitchenInvoice')->name('kitchen-invoice');
            Route::get('delete-order-item/{id}', 'deleteOrderItem')->name('delete-order-item');

            Route::get('add-product', 'addProduct')->name('add-product');
            Route::get('edit-product/{id}', 'editProduct')->name('edit-product');
            Route::post('save-product', 'saveProduct')->name('save-product');
            Route::get('list-product', 'listProduct')->name('list-product');
            Route::get('delete-product/{id}', 'deleteProduct')->name('delete-product');

            Route::get('io-stock', 'inOutStock')->name('io-stock');
            Route::post('save-stock', 'saveStock')->name('save-stock');
            Route::get('stock-history', 'stockHistory')->name('stock-history');
            Route::get('delete-stock-history/{id}', 'deleteStockHistory')->name('delete-stock-history');

            Route::get('settings', 'settingsForm')->name('settings');
            Route::post('/save-settings', 'saveSettings')->name('save-settings');

            Route::get('permissions-list', 'listPermission')->name('permissions-list');
            Route::post('/save-permissions', 'savePermission')->name('save-permissions');

            Route::get('dynamic-dropdown-list', 'listDynamicDropdowns')->name('dynamic-dropdown-list');
            Route::post('/save-dynamic-dropdowns', 'saveDynamicDropdowns')->name('save-dynamic-dropdowns');
        });

        Route::controller(CustomerController::class)->group(function(){
            Route::get('add-customer', 'addCustomer')->name('add-customer');
            Route::get('edit-customer/{id}', 'editCustomer')->name('edit-customer');
            Route::post('save-customer', 'saveCustomer')->name('save-customer');
            Route::get('list-customer', 'listCustomer')->name('list-customer');
            Route::get('delete-customer/{id}', 'deleteCustomer')->name('delete-customer');
        });

        Route::controller(VendorController::class)->group(function(){
            Route::get('add-vendor-category', 'addCategory')->name('add-vendor-category');
            Route::get('edit-vendor-category/{id}', 'editCategory')->name('edit-vendor-category');
            Route::post('save-vendor-category', 'saveCategory')->name('save-vendor-category');
            Route::get('list-vendor-category', 'listCategory')->name('list-vendor-category');
            Route::get('delete-vendor-category/{id}', 'deleteCategory')->name('delete-vendor-category');
        });

        Route::controller(VendorController::class)->group(function(){
            Route::get('add-vendor', 'add')->name('add-vendor');
            Route::get('edit-vendor/{id}', 'edit')->name('edit-vendor');
            Route::post('save-vendor', 'save')->name('save-vendor');
            Route::get('list-vendor', 'index')->name('list-vendor');
            Route::get('delete-vendor/{id}', 'delete')->name('delete-vendor');
            Route::get('view-vendor/{id}', 'view')->name('view-vendor');
        });

        Route::controller(HousekeepingController::class)->group(function(){
            Route::get('add-housekeeping-item', 'addItem')->name('add-housekeeping-item');
            Route::get('edit-housekeeping-item/{id}', 'editItem')->name('edit-housekeeping-item');
            Route::post('save-housekeeping-item', 'saveItem')->name('save-housekeeping-item');
            Route::get('list-housekeeping-item', 'listItem')->name('list-housekeeping-item');
            Route::get('delete-housekeeping-item/{id}', 'deleteItem')->name('delete-housekeeping-item');
            Route::get('view-housekeeping-item/{id}', 'viewItem')->name('view-housekeeping-item');
            Route::get('update-housekeeping-order-status/{order_id}/{status}', 'updateOrderStatus')->name('update-housekeeping-order-status');

            Route::get('add-housekeeping-order/{room_id?}/{reservation_id?}', 'addOrder')->name('add-housekeeping-order');
            Route::get('edit-housekeeping-order/{id}', 'editOrder')->name('edit-housekeeping-order');
            Route::post('save-housekeeping-order', 'saveOrder')->name('save-housekeeping-order');
            Route::get('list-housekeeping-order', 'index')->name('list-housekeeping-order');
            Route::get('delete-housekeeping-order/{id}', 'deleteOrder')->name('delete-housekeeping-order');
            Route::get('view-housekeeping-order/{id}', 'viewOrder')->name('view-housekeeping-order');
        });

        Route::controller(LaundryController::class)->group(function(){
            Route::get('add-laundry-item', 'addItem')->name('add-laundry-item');
            Route::get('edit-laundry-item/{id}', 'editItem')->name('edit-laundry-item');
            Route::post('save-laundry-item', 'saveItem')->name('save-laundry-item');
            Route::get('list-laundry-item', 'listItem')->name('list-laundry-item');
            Route::get('delete-laundry-item/{id}', 'deleteItem')->name('delete-laundry-item');
            Route::get('view-laundry-item/{id}', 'viewItem')->name('view-laundry-item');
            Route::get('update-laundry-order-status/{order_id}/{status}', 'updateOrderStatus')->name('update-laundry-order-status');

            Route::get('add-laundry-order', 'addOrder')->name('add-laundry-order');
            Route::get('edit-laundry-order/{id}', 'editOrder')->name('edit-laundry-order');
            Route::post('save-laundry-order', 'saveOrder')->name('save-laundry-order');
            Route::get('list-laundry-order', 'index')->name('list-laundry-order');
            Route::get('delete-laundry-order/{id}', 'deleteOrder')->name('delete-laundry-order');
            Route::get('view-laundry-order/{id}', 'viewOrder')->name('view-laundry-order');
            Route::get('invoice-laundry-order/{id}', 'invoice')->name('invoice-laundry-order');
        });

        Route::controller(SeasonController::class)->group(function(){
            Route::get('add-season', 'add')->name('add-season');
            Route::get('edit-season/{id}', 'edit')->name('edit-season');
            Route::post('save-season', 'save')->name('save-season');
            Route::get('list-season', 'index')->name('list-season');
            Route::get('delete-season/{id}', 'delete')->name('delete-season');
        });

        Route::controller(LanguageController::class)->group(function(){
            Route::get('language-translations', 'index')->name('language-translations');
    	    Route::post('/save-language-translations', 'saveTranslations')->name('save-language-translations');
        });

        Route::controller(ReportController::class)->group(function(){
            Route::get('/reports', 'index')->name('reports');

            Route::post('/search-orders', 'searchOrders')->name('search-orders');
            Route::post('/export-orders', 'exportOrders')->name('export-orders');

            Route::post('/search-stocks', 'searchStockHistory')->name('search-stocks');
            Route::post('/export-stocks', 'exportStockHistory')->name('export-stocks');

            Route::post('/search-checkins', 'searchCheckins')->name('search-checkins');
            Route::post('/export-checkins', 'searchCheckins')->name('export-checkins');

            Route::post('/search-checkouts', 'searchCheckouts')->name('search-checkouts');
            Route::post('/export-checkouts', 'searchCheckouts')->name('export-checkouts');

            Route::post('/search-expenses', 'searchExpense')->name('search-expenses');
            Route::post('/export-expenses', 'searchExpense')->name('export-expenses');

            Route::post('/search-customer', 'searchCustomer')->name('search-customer');
            Route::post('/export-customer', 'searchCustomer')->name('export-customer');

            Route::post('/search-payment-history', 'searchPaymentHistory')->name('search-payment-history');
            Route::post('/export-payment-history', 'searchPaymentHistory')->name('export-payment-history');

            Route::post('/search-laundry-order', 'searchLaundryOrder')->name('search-laundry-order');
            Route::post('/export-laundry-order', 'exportLaundryOrder')->name('export-laundry-order');
        });

        Route::controller(WebsitePagesController::class)->group(function(){
            Route::get('home-page', 'homePage')->name('home-page');
            Route::post('update-home-page', 'updateHomePage')->name('update-home-page');

            Route::get('contact-page', 'contactPage')->name('contact-page');
            Route::post('update-contact-data', 'updateContactPage')->name('update-contact-page');

            Route::get('about-page', 'aboutPage')->name('about-page');
            Route::post('update-about-data', 'updateAboutPage')->name('update-about-page');
        });
	});
});

Route::controller(CronController::class)->group(function () {
    Route::get('check-product-expiry', 'checkProductExpiry')->name('check-product-expiry');
});

Route::controller(PublicController::class)->group(function () {
    Route::get('langtrans', 'updateLangTransFromLocalFile')->name('langtrans');
});


Route::get('access-denied',function() { 
	return view('page_403');
})->name('access-denied');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Re-optimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Re-optimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//DB migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return '<h1>Data tables import success</h1>';
});

//clear cache and view
Route::get('/clear', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return '<div style="width: 100%;
    border: 2px dotted #3dcd96;
    background: #eee;
    color: #68696d;
    text-align: center;
    border-radius: 4px;"><h1>Config & View cache cleared successfully.</h1></div>';
});