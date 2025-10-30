<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\ProductSellerController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubCategoryController;



Route::get('/', function () {
    return view('welcome');
});

//admin routes
Route::middleware(['auth', 'verified','rolemanager:admin'])->group(function () {
  Route::prefix('admin')->group(function () {

    //admin main controller
    Route::controller(AdminMainController::class)->group(function () {
      Route::get('/','index')->name('admin');
      Route::get('/settings','settings')->name('admin.settings');
      Route::get('/manage/users','manage_user')->name('admin.manage.user');
      Route::get('/manage/store','manage_store')->name('admin.manage.store');
      Route::get('/cart/history','cart_history')->name('admin.cart.history');
      Route::get('/order/history','order_history')->name('admin.order.history');
    });

    //category controller
      Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/create','index')->name('admin.category.create');
        Route::get('/category/manage','manage')->name('admin.category.manage');
      });

      //subcategory controller
       Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/sub_category/create','index')->name('admin.sub_category.create');
        Route::get('/sub_category/manage','manage')->name('admin.sub_category.manage');
      });

      //product controller
       Route::controller(ProductController::class)->group(function () {
        Route::get('/product/manage','index')->name('admin.product.manage');
        Route::get('/product/manage_product_review','review_manage')->name('admin.product.manage_product_review');
      });

      //Product attribute controller
      Route::controller(ProductAttributeController::class)->group(function () {
        Route::get('/product_attribute/create','index')->name('admin.product_attribute.create');
        Route::get('/product_attribute/manage','manage')->name('admin.product_attribute.manage');
        Route::post('/defaultattribute/create','createattribute')->name('attribute.create');
        Route::get('/defaultattribute/{id}','showattribute')->name('attribute.show');
        Route::put('/defaultattribute/update/{id}','updateattribute')->name('attribute.update');
        Route::delete('/defaultattribute/delete/{id}','deleteattribute')->name('attribute.delete');
      });

      //discount controller
      Route::controller(ProductDiscountController::class)->group(function () {
        Route::get('/discount/create','index')->name('admin.discount.create');
        Route::get('/discount/manage','manage')->name('admin.discount.manage');
      });

       // master category controller
      Route::controller(MasterCategoryController::class)->group(function () {
        //store category
        Route::post('/store/category','storecat')->name('store.cat');
        //edit category
        Route::get('/category/{id}','showcat')->name('show.cat');
        //update category
        Route::put('/category/update/{id}','updatecat')->name('update.cat');
        //delete category
        Route::delete('/category/delete/{id}','deletecat')->name('delete.cat');

      });


          // master subcategory controller
      Route::controller(MasterSubCategoryController::class)->group(function () {
        //store category
        Route::post('/store/subcategory','storesubcat')->name('storesub.cat');
        //edit category
        Route::get('/subcategory/{id}','showsubcat')->name('show.subcat');
        //update category
        Route::put('/subcategory/update/{id}','updatesubcat')->name('update.subcat');
        //delete category
        Route::delete('/subcategory/delete/{id}','deletesubcat')->name('delete.subcat');

      });

      
  });
});


//vendors routes
Route::middleware(['auth', 'verified','rolemanager:vendor'])->group(function () {
  Route::prefix('vendor')->group(function () {

    //vendors main controller
    Route::controller(SellerMainController::class)->group(function () {
      Route::get('/dashboard','index')->name('vendor');
      Route::get('/order/history','orderhistory')->name('vendor.order.history');
    });

     Route::controller(ProductSellerController::class)->group(function () {
      Route::get('/product/create','index')->name('vendor.product.create');
      Route::get('/product/manage','manage')->name('vendor.product.manage');
    });

     Route::controller(SellerStoreController::class)->group(function () {
      Route::get('/store/create','index')->name('vendor.store.create');
      Route::get('/store/manage','manage')->name('vendor.store.manage');
      Route::post('/store/publish','store')->name('create.store');
      Route::get('/store/edit/{id}','edit')->name('edit.store');
      Route::put('/store/update/{id}','update')->name('update.store');
      Route::delete('/store/delete/{id}','delete')->name('delete.store');
    });
  });
});


//customer routes
Route::middleware(['auth', 'verified','rolemanager:customer'])->group(function () {
  Route::prefix('user')->group(function () {
      Route::controller(CustomerMainController::class)->group(function () {
        Route::get('/dashboard','index')->name('dashboard');
        Route::get('/order/history','history')->name('customer.history');
        Route::get('/setting/payment','payment')->name('customer.payment');
        Route::get('/affiliate','affiliate')->name('customer.affiliate');
      });
 
  });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
