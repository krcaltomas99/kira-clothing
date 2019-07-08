<?php

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

Auth::routes();
Route::get("/KC-admin/2ýžhs7429sj28sjsaí2", "SystemController@migrate")->name("migrate");
Route::get("/KC-admin/7aUaoe0pyAsds29apa", "SystemController@rollback")->name("rollback");
Route::get("/privacypolicy", "SystemController@privacypolicy")->name("privacypolicy");

//FRONT END
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get("/product/{id}/{slug?}", "ProductsController@show")->name("showProduct");

//Cart stuff
Route::get("/cart", "CartController@index")->name("cart.index");
Route::post("/cart/{id}", "CartController@store")->name("cart.store");
Route::delete("/cart/{product}", "CartController@destroy")->name("cart.destroy");
Route::post("/cart/update/chngqty", "CartController@update")->name("cart.changeqty");
Route::post("/cart/update/chngsize", "CartController@updateSize")->name("cart.changesize");

//USER INTERFACE
Route::get("/user/settings", "UsersController@index")->name("users.index");
Route::put("/user/settings/{id}", "UsersController@update")->name("users.update");
Route::get("/user/settings/changeavatardefault/{id}", "UsersController@changeToDefault")->name("users.changeToDefault");
Route::get("/user/settings/password", "UsersController@pass")->name("users.pass");
Route::put("/user/settings/password/{id}", "UsersController@updatePass")->name("users.updatePass");
Route::get("/user/settings/shipping", "UsersController@shipping")->name("users.shipping");
Route::put("/user/settings/shipping/{id}", "UsersController@updateShipping")->name("users.updateShipping");
Route::post("/user/settings/shipping/{id}", "UsersController@storeShipping")->name("users.storeShipping");
Route::get("/user/orders", "UsersController@orders")->name("users.orders");
Route::get("/user/orders/{id}/faktura", "OrdersController@invoice")->name("orders.invoice");
Route::delete("/user/orders/{id}/delete", "OrdersController@order")->name("orders.delete");

//PAYMENTS
Route::post("/create-payment", "PaymentController@create");
Route::post("/execute-payment", "PaymentController@execute");
Route::post("/paymentsuccess", "PaymentController@success");
Route::get("/thankyou", "PaymentController@thankyou")->name("thankyou");

//Checkout stuff
Route::get("/checkout", "CheckoutController@index")->name("checkout.index");
Route::post("/checkout", "CheckoutController@store")->name("checkout.store");


//API AJAX CALLS
Route::get("/getcart", "ProductsController@getCart");

//Products by collection
Route::get("/collections/{slug}", "CollectionsController@show")->name("showCollection");
Route::post("/collectionclick", "CollectionsController@click")->name("collectionclick");

Route::get("/categories/{slug}", "SectionsController@show")->name("homesections.show");

//Search for products
Route::get("/search", "ProductsController@search")->name("searchProducts");
Route::get("/searchfilter", "ProductsController@filter")->name("products.filterSearch");
Route::get("/clearsearch", "ProductsController@emptySearch")->name("products.clearSearch");
Route::post("/rate", "ProductsController@rate");


//BACK END
Route::get("/KC-admin", "AdminController@index")->name("admin.index");
Route::get("/KC-admin/dashboard", "AdminController@index")->name("admin.index");
Route::get("/KC-admin/login", "AdminController@login")->name("admin.login");

// Admin users
Route::get("/KC-admin/user/customers", "AdminUsersController@customers")->name("admin.users.clients");
Route::get("/KC-admin/user/employees", "AdminUsersController@employees")->name("admin.users.employees");
Route::get("/KC-admin/user/users", "AdminUsersController@users")->name("admin.users.user");
//User edit page in admin
Route::get("/KC-admin/user/{id}/edit", "AdminUsersController@edit")->name("admin.users.edit");
Route::put("/KC-admin/user/{id}", "AdminUsersController@update")->name("admin.users.update");
Route::delete("/KC-admin/user/{id}", "AdminUsersController@destroy")->name("admin.users.destroy");

Route::get("/KC-admin/orders", "AdminOrdersController@index")->name("admin.orders.index");
Route::get("/KC-admin/orders/{id}", "AdminOrdersController@edit")->name("admin.orders.edit");
Route::put("/KC-admin/orders/{id}", "AdminOrdersController@update")->name("admin.orders.update");
Route::put("/KC-admin/orders/{id}/products", "AdminOrdersController@updateProducts")->name("admin.orders.updateProducts");
Route::get("/KC-admin/orders/{id}/finish", "AdminOrdersController@finish")->name("admin.orders.finish");
Route::delete("/KC-admin/orders/{id}", "AdminOrdersController@destroy")->name("admin.orders.destroy");

// Admin products
Route::delete("/KC-admin/products/destroyImages", "AdminProductsController@destroyMultipleImages");
Route::delete("/KC-admin/products/destroyImg/image/{id}", "AdminProductsController@destroyImg")
	->name("destroyImg");
Route::resource("/KC-admin/products", "AdminProductsController", [
	"except" => "show"
]);

//API AJAX CALLS
Route::post("/addtofavorites", "ProductsController@addProductToFavorites")->name("products.addToFavorites");
Route::get("/loadmoreproducts/{offset}", "HomeController@loadmoreproducts");
Route::get("/getfavorites", "ProductsController@getFavorites");
Route::get("/getlastvisited", "ProductsController@getLastVisited");
Route::post("/addtorecommended", "ProductsController@addToRecommended");
Route::get("/getrecommendedproducts", "ProductsController@getRecommended");

//AJAX Search
Route::get("/ajax-search", "ProductsController@ajaxsearch");
Route::get("/filter-products", "SectionsController@filter")->name("products.filter");
Route::get("/filter-collection-products", "CollectionsController@filter")->name("products.filterCollections");

//Update formuláře
Route::put("/KC-admin/products/{id}/updateTags", "AdminProductsController@updateTags")->name("products.updateTags");
Route::put("/KC-admin/products/{id}/updatePhotos", "AdminProductsController@updatePhotos")->name("products.updatePhotos");
Route::put("/KC-admin/products/{id}/updateQuantities", "AdminProductsController@updateQuantities")->name("products.updateQuantities");
Route::put("/KC-admin/products/{id}/updateColors", "AdminProductsController@updateColors")->name("products.updateColors");
Route::post("/KC-admin/products/storeSku", "AdminProductsController@storeSku")->name("products.storeSku");

Route::post("/KC-admin/products/ajax-upload/{productId}", "AdminProductsController@ajaxImgUpload")
	->name("product-ajax-upload");
Route::post("/KC-admin/products/uploadMoreImages", "AdminProductsController@uploadMultipleImages")
	->name("uploadMoreImages");
Route::post("/KC-admin/products/updateImgPosition", "AdminProductsController@updatePhotosPosition");
Route::post("/KC-admin/products/updateSlidesPosition", "AdminSlidersController@updateSlidesPosition");


// Admin sliders
Route::resource("/KC-admin/sliders", "AdminSlidersController", [
	"except" => "show"
]);
Route::post("/click", "SlidersController@click");
Route::put("/KC-admin/sliders/{id}/changeActive", "AdminSlidersController@changeActive")->name("sliders.changeActive");

// Admin collections
Route::resource("/KC-admin/collections", "AdminCollectionsController", [
	"except" => "show"
]);

// Admin sections
Route::resource("/KC-admin/sections", "AdminSectionsController");

// Admin tags
Route::resource("/KC-admin/tags", "AdminTagsController", [
	"except" => "show"
]);

Route::get('adminauth/google', 'SocialAuthController@redirectToAdminProvider');

Route::get('auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'SocialAuthController@handleProviderCallback');
