<?php
Route::name('bageur.')->group(function () {
	// Route::group(['prefix' => 'bageur/v1','middleware' => 'jwt.verify'], function () {
	Route::group(['prefix' => 'bageur/v1'], function () {
		Route::apiResource('produk', 'bageur\ecommerce\ProdukCmsController');
		Route::apiResource('order', 'bageur\ecommerce\OrderCmsController');
	});
});
