<?php
Route::name('bageur.')->group(function () {
	// Route::group(['prefix' => 'bageur/v1','middleware' => 'jwt.verify'], function () {
	Route::group(['prefix' => 'bageur/v1'], function () {
		Route::apiResource('produk', 'bageur\ecommerce\ProdukCmsController');
		Route::apiResource('order', 'bageur\ecommerce\OrderCmsController');
		Route::apiResource('kategori', 'bageur\ecommerce\KategoriController');
		Route::apiResource('comment', 'bageur\ecommerce\CommentController');
		Route::apiResource('review', 'bageur\ecommerce\ReviewController');
		Route::apiResource('cart', 'bageur\ecommerce\CartController');
	});
});
