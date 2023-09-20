<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSupplierController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminPurchaseController;
use App\Http\Controllers\Admin\AdminProformaController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function()
{
    return Redirect::guest('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','user-access:admin'])->group(function(){
    Route::resource('admin/member', AdminMemberController::class)->names('admin.member');
    Route::resource('admin/supplier', AdminSupplierController::class)->names('admin.supplier');
    Route::resource('admin/client', AdminClientController::class)->names('admin.client');
    Route::resource('admin/inventory', AdminInventoryController::class)->names('admin.inventory');
    Route::resource('admin/purchase', AdminPurchaseController::class)->names('admin.purchase');
    Route::resource('admin/proforma', AdminProformaController::class)->names('admin.proforma');
    Route::resource('admin/invoice', AdminInvoiceController::class)->names('admin.invoice');
    Route::get('generatepdf', [AdminMemberController::class, 'generatepdf'])->name('admin.member.generatepdf');

    Route::get('admin/supplier/download/{id}',[AdminSupplierController::class, 'download'])->name('admin.supplier.download');
    Route::get('admin/client/download/{id}',[AdminClientController::class, 'download'])->name('admin.client.download');
    Route::get('admin/inventory/download/{id}',[AdminInventoryController::class, 'download'])->name('admin.inventory.download');
    Route::get('admin/purchase/download/{id}',[AdminPurchaseController::class, 'download'])->name('admin.purchase.download');
    Route::get('admin/proforma/download/{id}',[AdminProformaController::class, 'download'])->name('admin.proforma.download');
    Route::get('admin/invoice/download/{id}',[AdminInvoiceController::class, 'download'])->name('admin.invoice.download');

    Route::get('admin/profile', [AdminProfileController::class,'index'])->name('admin.profile');
    Route::put('admin/profile', [AdminProfileController::class,'update'])->name('admin.profile.update');
});

Route::middleware(['auth','user-access:member'])->group(function(){
    Route::get('member/profile', [MemberProfileController::class,'index'])->name('member.profile');
    Route::put('member/profile', [MemberProfileController::class,'update'])->name('member.profile.update');
});