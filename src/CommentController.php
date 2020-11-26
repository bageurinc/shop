<?php

namespace Bageur\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bageur\Ecommerce\model\comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment = comment::where('id_user',Auth::id())->datatable($request);
        return $comment;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment =  new comment;
        $comment->id_produk = $request->id_produk;
        $comment->id_user   = Auth::id();
        $comment->id_parent = $request->id_parent;
        $comment->comment   = $request->comment;
        $comment->save();

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
        $comment =  comment::findorFail($id);
        return $comment;
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
        $comment =  comment::findorFail($id);
        $comment->id_produk = $request->id_produk;
        $comment->id_user   = Auth::id();
        $comment->id_parent = $request->id_parent;
        $comment->comment   = $request->comment;
        $comment->save();

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
        $comment = comment::findOrFail($id);
        $comment->delete();

        return response(['status' => true ,'text'    => 'has delete'], 200);
    }
}
