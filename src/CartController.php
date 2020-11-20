<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bageur\Ecommerce\model\cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = cart::where('id_user',Auth::id())->with(['produk'])->datatable($request);
        return $cart;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart =  new cart;
        $cart->id_produk = $request->id_produk;
        $cart->id_user   = Auth::id();
        $cart->catatan   = $request->catatan;
        $cart->qty       = $request->qty;
        $cart->save();

        return response(['status' => true ,'text'    => 'has input'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart =  cart::findorFail($id);
        return $cart;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart =  cart::findorFail($id);
        $cart->id_produk = $request->id_produk;
        $cart->id_user   = Auth::id();
        $cart->catatan   = $request->catatan;
        $cart->qty       = $request->qty;
        $cart->save();
        return response(['status' => true ,'text'    => 'has update'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = cart::findOrFail($id);
        $cart->delete();

        return response(['status' => true ,'text'    => 'has delete'], 200);

    }
}
