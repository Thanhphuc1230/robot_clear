<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CateNewController;
use App\Http\Controllers\Admin\CateProductController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController as Contact;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdsController;

use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PageController as Page;
use App\Http\Controllers\Website\NewsController as News;
use App\Http\Controllers\Website\ProductController as Product;
use App\Http\Controllers\Website\SearchController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckOutController;

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
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'getLogin')->name('getLogin');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/post_login', 'postLogin')->name('postLogin');
});

Route::name('website.')
    ->middleware(['web', 'logVisit'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        // Contact
        Route::get('/lien-he.html', [ContactController::class, 'contact'])->name('contact');
        Route::post('/gui-yeu-cau-lien-he', [ContactController::class, 'postContact'])->name('postContact');
        Route::post('/dang-ky-nhan-thong-bao', [ContactController::class, 'postSubscribe'])->name('postSubscribe');
        //search
        Route::post('/search.html', [SearchController::class, 'search'])->name('search');
        Route::get('/tim-kiem.html', [SearchController::class, 'searchNow'])->name('searchNow');
        //cart
        Route::get('/gio-hang.html', [CartController::class, 'cart'])->name('cart');
        Route::get('/add-to-cart/{uuid}/{quantity?}', [CartController::class, 'addToCart'])->name('addToCart');
        Route::post('/update-cart.html', [CartController::class, 'updateCart'])->name('updateCart');
        Route::get('/remove-item-cart/{id}', [CartController::class, 'removeItemCart'])->name('removeItemCart');
        //checkout
        Route::get('/thanh-toan.html', [CheckOutController::class, 'checkout'])->name('checkout');
        Route::post('thanh-toan/store.html', [CheckOutController::class, 'checkoutStore'])->name('checkout.store');
        Route::get('/thanh-toan-thanh-cong.html', [CheckOutController::class, 'orderSuccess'])->name('orderSuccess');

        Route::get('/san-pham/all.html', [Product::class, 'categoryAll'])->name('categoryAll');

        //Pages content
        Route::get('/{name_page}.html', [Page::class, 'page'])->name('page');

        Route::get('/chi-tiet-san-pham/{name_product}.html', [Product::class, 'detailProduct'])->name('detailProduct');

        // Product child
        Route::get('/{name_cate_product}.html', [Product::class, 'categoryProduct'])->name('categoryProduct');
        Route::get('/{name_cate}/{name_cate_child}.html', [Product::class, 'categoryProductChild'])->name('categoryProductChild');

        //Category News
        Route::get('/{name_cate}.html', [News::class, 'categoryNews'])->name('categoryNews');
        Route::get('/{name_cate}/{name_new}.html', [News::class, 'detailNew'])->name('detailNew');
    });

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('checkAdmin')
    ->group(function () {
        // Chart
        Route::controller(ChartController::class)
            ->prefix('chart')
            ->name('chart.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
        // Profile admin
        Route::controller(ProfileController::class)
            ->prefix('profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::post('/change_password', 'changePassword')->name('changePassword');
            });
        //Trang quản trị viên
        Route::controller(UserController::class)
            ->prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        //Trang quản trị viên
        Route::controller(PageController::class)
            ->prefix('page')
            ->name('page.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}/{page}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::post('/destroyAll', 'destroyAll')->name('destroyAll');
            });

        //Page category new
        Route::controller(CateNewController::class)
            ->prefix('category_new')
            ->name('category_new.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}/{page}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::post('/destroyAll', 'destroyAll')->name('destroyAll');
            });
        //Page new
        Route::controller(NewsController::class)
            ->prefix('news')
            ->name('news.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}/{page}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::post('/destroyAll', 'destroyAll')->name('destroyAll');
            });
        //Page category product
        Route::controller(CateProductController::class)
            ->prefix('category_product')
            ->name('category_product.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}/{page}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::post('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::post('/destroyAll', 'destroyAll')->name('destroyAll');
            });
        //Trang Sản phẩm
        Route::controller(ProductController::class)
            ->prefix('product')
            ->name('product.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        // Quản lý hệ thống
        Route::controller(SystemController::class)
            ->prefix('system')
            ->name('system.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
            });
        // Quản lý thông tin giới thiệu
        Route::controller(AboutController::class)
            ->prefix('about')
            ->name('about.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
            });
        //Page menu
        Route::controller(MenuController::class)
            ->prefix('menu')
            ->name('menu.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        // Slider
        Route::controller(SliderController::class)
            ->prefix('slider')
            ->name('slider.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        Route::controller(AdsController::class)
            ->prefix('ads')
            ->name('ads.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        // Manage contact
        Route::controller(Contact::class)
            ->prefix('contact')
            ->name('contact.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::post('/update/{uuid}', 'update')->name('update');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
        //Order manage
        Route::controller(OrderController::class)
            ->prefix('order')
            ->name('order.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/status/{uuid}/{status}/{name}', 'status')->name('status');
                Route::get('/edit/{uuid}', 'edit')->name('edit');
                Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
            });
    });
