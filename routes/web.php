<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalUploadController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomTypeUploadController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasMembership;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsGuest;
use Illuminate\Support\Facades\Route;
use Spatie\Csp\AddCspHeaders;



Route::get('/', [HomeController::class, 'home'])->name('/');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::middleware([EnsureUserIsAdmin::class])->group(function ()  
    {
        Route::group(['prefix'=>'admin'], function () {

            Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            Route::get('/managevendor', function () {
                return view('admin.manage-vendor');
            })->name('admin.managevendor');

            Route::get('/manageadmin', function () {
                return view('admin.manage-admin');
            })->name('admin.manageadmin');


            Route::get('/manageguest', function () {
                return view('admin.manage-guest');
            })->name('admin.manageguest');

            Route::get('/manageproperty', function () {
                return view('admin.manage-vendor-property');
            })->name('admin.manageproperty');

            Route::post('/create-admin-account', [AdminController::class, 'store'])->name('admin.store');
            Route::get('/{user}/delete-admin-account', [AdminController::class, 'destroy'])->name('admin.delete');

            Route::get('/{user}/edit-vendor-account', [UserController::class, 'edit'])->name('vendor.edit');
            Route::get('/{user}/update-vendor-account', [UserController::class, 'update'])->name('vendor.update');
            Route::get('/{user}/delete-vendor-account', [UserController::class, 'destroy'])->name('vendor.delete');

            Route::get('/{rental}/approve', [AdminController::class, 'approve'])->name('admin.approve');
            Route::get('/{rental}/disapprove', [AdminController::class, 'disapprove'])->name('admin.disapprove');
        });
    });

    Route::middleware([EnsureUserHasMembership::class])->group(function () {
        Route::get('account_session/payment', [DashboardController::class, 'sessionPayment'])->name('account.session.payment');
        Route::get('account_session/account-login', [DashboardController::class, 'sessionAccountLogin'])->name('account.session.login');
        Route::get('account_session/account-management', [DashboardController::class, 'sessionAccountManagement'])->name('account.session.accountManagement');
        Route::get('account_session/balance', [DashboardController::class, 'sessionBalance'])->name('account.session.balance');
        Route::get('account_session/documents', [DashboardController::class, 'sessionDocuments'])->name('account.session.documents');
        Route::get('account_session/payment-method-settings', [DashboardController::class, 'sessionPaymentSettings'])->name('account.session.paymentSettings');
        Route::get('account_session/reporting-chart', [DashboardController::class, 'sessionReportingChart'])->name('account.session.reporting');
        Route::get('account_session/notification', [DashboardController::class, 'sessionNotification'])->name('account.session.notification');
        Route::get('account_session/tax-registrations', [DashboardController::class, 'sessionTaxRegistrations'])->name('account.session.taxaRegistrations');
        Route::get('account_session/tax-settings', [DashboardController::class, 'sessionTaxSettings'])->name('account.session.taxSettings');

        Route::group(['prefix'=>'dashboard'], function () {
            
            Route::get('/', function () {
                return view('dashboard');
            })->name('dashboard');
            Route::get("/analytics", function() {
                return view('vendors.analytics');
            })->name("analytics");
        
            Route::get("listing", [RentalController::class, 'index'])->name("listing");
        
            Route::get("/documentation", function() {
                return view('vendors.documentation');
            })->name("documentation");
            
            // Cancel Membership
            Route::get("billing/subscriptions/cancel", [PaymentController::class, 'cancelSubscriptions'])->name('cancel.billing.subscriptions');
    
            // Rental
            Route::get("billing", [PaymentController::class, 'billing'])->name('vendor.billing');
            Route::get("listing/create", [RentalController::class, 'create'])->name('create.rental');
            Route::get("listing/calendar", [RentalController::class, 'calendar'])->name('calendar.rental');
            Route::get("listing/{rental}/edit", [RentalController::class, 'edit'])->name('edit.rental');
            Route::get("listing/{rental}/edit/manageimage", [RentalController::class, 'image'])->name('image.rental');
            Route::get("listing/{rental}/update", [RentalController::class, 'update'])->name('update.rental');
            Route::get("listing/{rental}/resumbit", [RentalController::class, 'resubmit'])->name('resubmit.rental');
            Route::get("listing/{rental}/delete", [RentalController::class, 'destroy'])->name('delete.rental');
            Route::post('listing/store', [RentalController::class, 'store'])->name('store.rental');

            Route::get("listing/guest", [RentalController::class, 'guest'])->name('vendor,guest');

            Route::post('listing/{rental}/booking', [BookingController::class, 'index'])->name('booking'); 

            Route::get('connect/cashier', [StripeController::class, 'board'])->name('create.stripe'); 
             // Room Type
             Route::get("listing/{rental}/create", [RoomTypeController::class, 'create'])->name('create.roomtype');
             Route::get("listing/{rental}/{roomtype}/edit", [RoomTypeController::class, 'edit'])->name('edit.roomtype');
             Route::get("listing/{rental}/{roomtype}/update", [RoomTypeController::class, 'update'])->name('update.roomtype');
             Route::get("listing/{rental}/{roomtype}/delete", [RoomTypeController::class, 'destroy'])->name('delete.roomtype');
             Route::post('listing/{rental}/store', [RoomTypeController::class, 'store'])->name('store.roomtype');
             Route::get("listing/{rental}/{roomtype}/edit/manageimage", [RoomTypeController::class, 'image'])->name('image.roomtype');

            // Room Type
            Route::post('listing/{rental}/{roomtype}/createroom', [RoomController::class, 'create'])->name('create.room');
            Route::post('listing/{rental}/{roomtype}/storeroom', [RoomController::class, 'store'])->name('store.room');
            Route::get("listing/{rental}/{roomtype}/{room}/deleteroom", [RoomController::class, 'destroy'])->name('delete.room');
            
            // Post rental images
            Route::post('{rental}/store', [RentalUploadController::class, 'store_rental'])->name('rental.image.store');
            Route::get('{rental}/{image}/delete', [RentalUploadController::class, 'destroy_rental'])->name('rental.image.delete');

            // Post rental images
            Route::post('{rental}/{roomtype}/store', [RoomTypeUploadController::class, 'store_room'])->name('room.image.store');
            Route::get('{rental}/{roomtype}/{image}/delete', [RoomTypeUploadController::class, 'destroy_room'])->name('room.image.delete');

        });
    });

    // Membership
    Route::view("pricing", "pricing")
    ->name("pricing");

    Route::get('checkout/{plan?}',
        [CheckoutController::class, 'purchaseSubscriptionOne']
    )->name("checkout");

    Route::get('success', [PaymentController::class, 'success'])
    ->name('success');


    Route::middleware([EnsureUserIsGuest::class])->group(function ()  
    {
    Route::get('/guest-dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');
    Route::get('/guest-purchases', [GuestController::class, 'purchases'])->name('guest.purchases');
    Route::get('/guest-shoppingcart', [GuestController::class, 'shoppingcart'])->name('guest.shoppingcart');
    Route::get('/guest-bookings', [GuestController::class, 'bookings'])->name('guest.bookings');
    Route::get('/guest-notification', [GuestController::class, 'notification'])->name('guest.notification');
    });

    Route::post('addtoshoppingcart/{rental}/{roomtype}/{checkin}/{checkout}', [ShoppingCartController::class, 'store'])->name('cart.store');
    Route::get('/{rental}/{url}/{checkin}/{checkout}/check-out-form', [CheckoutController::class, 'shoppingcartForm'])->name('cart.checkoutForm');
    Route::get('/purchase', [CheckoutController::class, 'shoppingcartPurchase'])->name('cart.purchase');

    Route::get('{rental}/{url}/{checkin}/{checkout}/check-out', [CheckoutController::class, 'shoppingcartCheckout'])->name('cart.checkout');
    Route::get('removeToShoppingCart/{booking}', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');

    Route::get('stripe/boarding/{user}', [StripeController::class, 'handleBoardingRedirect']);
});

Route::get('listing/{rental}/show', [RentalController::class, 'show'])->name('show.rental');
Route::get('listing/search', [RentalController::class, 'search'])->name('show.search');



Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);


