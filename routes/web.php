<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Admin\BusinessProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EstimateController;
use App\Http\Controllers\Admin\EstimateDetailController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MasterRoomController;
use App\Http\Controllers\Admin\MasterWorkitemController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\UserAlertController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkitemController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // User Alert
    Route::get('user-alerts/seen', [UserAlertController::class, 'seen'])->name('user-alerts.seen');
    Route::resource('user-alerts', UserAlertController::class, ['except' => ['store', 'update', 'destroy']]);

    // Master Room
    Route::resource('master-rooms', MasterRoomController::class, ['except' => ['store', 'update', 'destroy']]);

    // Master Workitems
    Route::post('master-workitems/csv', [MasterWorkitemController::class, 'csvStore'])->name('master-workitems.csv.store');
    Route::put('master-workitems/csv', [MasterWorkitemController::class, 'csvUpdate'])->name('master-workitems.csv.update');
    Route::resource('master-workitems', MasterWorkitemController::class, ['except' => ['store', 'update', 'destroy']]);

    // Business Profile
    Route::resource('business-profiles', BusinessProfileController::class, ['except' => ['store', 'update', 'destroy']]);

    // Branding
    Route::post('brandings/media', [BrandingController::class, 'storeMedia'])->name('brandings.storeMedia');
    Route::resource('brandings', BrandingController::class, ['except' => ['store', 'update', 'destroy']]);

    // Terms
    Route::resource('terms', TermController::class, ['except' => ['store', 'update', 'destroy']]);

    // Customer
    Route::resource('customers', CustomerController::class, ['except' => ['store', 'update', 'destroy']]);

    // Estimate
    Route::get('estimates/create/{id?}', [
        'uses' => 'App\Http\Controllers\Admin\EstimateController@create',
    ])->name('estimates.create');
    Route::resource('estimates', EstimateController::class, ['except' => ['create' , 'store', 'update', 'destroy']]);
    //Route::resource('estimates', EstimateController::class, ['except' => ['store', 'update', 'destroy']]);

    // Rooms
    Route::resource('rooms', RoomController::class, ['except' => ['store', 'update', 'destroy']]);

    // Workitem
    Route::resource('workitems', WorkitemController::class, ['except' => ['store', 'update', 'destroy']]);

    // Estimate Detail
    Route::get('estimate-details/create/{estimate_id?}', [
                    'uses' => 'App\Http\Controllers\Admin\EstimateDetailController@create',
                    ])->name('estimate-details.create');
   Route::resource('estimate-details', EstimateDetailController::class, ['except' => ['create','store', 'update', 'destroy']]);
    //Route::resource('estimate-details', EstimateDetailController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
