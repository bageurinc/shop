<?php

namespace Bageur\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bageur\Ecommerce\model\review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $review = review::where('id_user',Auth::id())->with(['produk'])->datatable($request);
        return $review;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review             =  new review;
        $review->id_produk  = $request->id_produk;
        $review->id_user    = Auth::id();
        $review->rating     = $request->rating;
        $review->keterangan = $request->keterangan;
        $review->save();

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
        $review =  review::findorFail($id);
        return $review;
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
        $review =  review::findorFail($id);
        $review->id_produk  = $request->id_produk;
        $review->id_user    = Auth::id();
        $review->rating     = $request->rating;
        $review->keterangan = $request->keterangan;
        $review->save();

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
        $review = review::findOrFail($id);
        $review->delete();

        return response(['status' => true ,'text'    => 'has delete'], 200);
    }
}
