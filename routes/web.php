<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::post('/agency-login/{user}', [App\Http\Controllers\Frontend\AgencyController::class, 'agencylogin'])->name('owner-login');
    Route::post('/agency-activate/{user}', [App\Http\Controllers\Frontend\AgencyController::class, 'activateOwner'])->name('activate-owner');
    Route::post('/agencies/{user}/change-password', [App\Http\Controllers\Frontend\AgencyController::class, 'changePassword'])->name('change-password');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('agencies', App\Http\Controllers\Frontend\AgencyController::class)->only(['create', 'store', 'index']);
});

Route::group(['middleware' => ['auth', 'check_agency_exists', 'is_active']], function () {
    Route::get('/dashboard',  App\Http\Livewire\Admin\Dashboard\Dashboard::class)->name('dashboard');
    Route::get('users', App\Http\Livewire\Admin\Users\Users::class)->name('users');
    Route::get('roles', App\Http\Livewire\Admin\Roles\Roles::class)->name('roles');
    Route::get('roles/create', App\Http\Livewire\Admin\Roles\Create::class)->name('roles.create');
    Route::get('roles/edit/{role}', App\Http\Livewire\Admin\Roles\Edit::class)->name('roles.edit');
    Route::get('permissions', App\Http\Livewire\Admin\Permissions\Permissions::class)->name('permissions');
    Route::get('customers', App\Http\Livewire\Admin\Customers\Customers::class)->name('customers');
    Route::get('property-draft', App\Http\Livewire\Admin\Properties\PropertiesDraft::class)->name('properties-draft');

    Route::get('properties', App\Http\Livewire\Admin\Properties\Properties::class)->name('properties');
    Route::get('properties/create', App\Http\Livewire\Admin\Properties\Create::class)->name('properties.create');
    Route::get('properties/edit/{property}', App\Http\Livewire\Admin\Properties\Edit::class)->name('properties.edit');

    Route::get('property-draft-edit/{property}', App\Http\Livewire\Admin\Properties\EditDraft::class)->name('property-draft-edit');
    Route::get('properties/{property}/close-deal', App\Http\Livewire\Admin\Properties\CloseDeal::class)->name('properties.close-deal');
    Route::get('properties/{property}/matches', App\Http\Livewire\Admin\Properties\PropertyRequirementMatches::class)->name('properties.matches');
    Route::get('properties/{property}', App\Http\Livewire\Admin\Properties\Show::class)->name('properties.show');
    Route::get('closed-deals', App\Http\Livewire\Admin\Deals\ClosedDeals::class)->name('closed-deals');
    Route::get('confirm-deal/{propertyDeal}', App\Http\Livewire\Admin\Deals\ConfirmDeal::class)->name('confirm-deal');
    Route::get('deals', App\Http\Livewire\Admin\Deals\Deals::class)->name('deals');
    Route::get('property-requirements', App\Http\Livewire\Admin\PropertyRequirements\PropertyRequirements::class)->name('property-requirements');
    Route::get('property-requirement-draft', App\Http\Livewire\Admin\PropertyRequirements\PropertyRequirementDraft::class)->name('properties-requirement-draft');
    Route::get('property-requirement-draft/edit/{propertyRequirement}', App\Http\Livewire\Admin\PropertyRequirements\EditDraft::class)->name('property-requirement-draft-edit');

    Route::get('property-requirements/create', App\Http\Livewire\Admin\PropertyRequirements\Create::class)->name('property-requirements.create');
    Route::get('property-requirements/edit/{propertyRequirement}', App\Http\Livewire\Admin\PropertyRequirements\Edit::class)->name('property-requirements.edit');
    Route::get('property-requirements/{propertyRequirement}', App\Http\Livewire\Admin\PropertyRequirements\Show::class)->name('property-requirements.show');
    Route::get('property-requirements/{propertyRequirement}/close-deal', App\Http\Livewire\Admin\PropertyRequirements\CloseDeal::class)->name('property-requirements.close-deal');
    Route::get('property-requirements/{propertyRequirement}/matches', App\Http\Livewire\Admin\PropertyRequirements\PropertyMatches::class)->name('property-requirements.matches');
    Route::get('profile', App\Http\Livewire\Admin\Profile\Profile::class)->name('profile');
});

Route::group(['middleware' => ['guest']], function () {
    Route::view('/', 'welcome')->name('welcome');
    Route::view('/lead', 'lead')->name('lead');
    Route::view('privacy-policy', 'privacy-policy')->name('privacy-policy');
    Route::post('/add-info', [App\Http\Controllers\Frontend\AddInfoController::class, 'adduserinfo'])->name('add-info');
    Route::post('/add-subscription', [App\Http\Controllers\Frontend\AddInfoController::class, 'addsubscription'])->name('add-subscription');
    Route::post('/password-reset', App\Http\Controllers\Frontend\ResetPassword::class)->name('password-reset');
    Route::get('/verify-phone', [App\Http\Controllers\Auth\VerifyPhoneController::class, 'verify'])->name('verify');
    Route::get('/property/{property}', App\Http\Controllers\Frontend\PropertyShareController::class);
    Route::view('/trial-expiry', 'auth.trial-expiry')->name('trial-expiry');
    Route::get('/payment-methods', [App\Http\Controllers\Frontend\PaymentController::class, 'index'])->name('payment-methods');
    Route::get('/payment-details', [App\Http\Controllers\Frontend\PaymentController::class, 'create'])->name('payment-details');
    Route::post('/payment-details', [App\Http\Controllers\Frontend\PaymentController::class, 'store'])->name('payment-details.store');
    Route::view('/forgot-password', 'frontend.agency.change-password')->name('forgot-password');
});
require __DIR__ . '/auth.php';



