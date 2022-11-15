<?php

namespace Bageur\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bageur\Ecommerce\processors\Helper;
use Bageur\Ecommerce\model\kategori;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori = kategori::datatable($request);
        return $kategori;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules    	= [
                        'nama'                  => 'required',
                        'status'                => 'required',

                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
        $kategori =  new kategori;
        // $kategori->id_user   = Auth::id();
        $kategori->nama      = $request->nama;
        $kategori->status    = $request->status;
        if($request->file != null){
            $upload                = Helper::avatarbase64($request->file,'kategori');
            $kategori->gambar	           = $upload['up'];
            $kategori->gambar_path           = $upload['path'];
           }
        $kategori->save();

        return response(['status' => true ,'text'    => 'has input'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori =  kategori::findorFail($id);
        return $kategori;
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
        $rules    	= [
                        'nama'                  => 'required',
                        'status'                => 'required',
                        'file'		     	=> 'nullable|base64image|base64max:1000',
                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
        $kategori =  kategori::findorFail($id);
        $kategori->id_user   = Auth::id();
        $kategori->nama      = $request->nama;
        $kategori->status    = $request->status;
        if($request->file != null){
            $upload                = Helper::avatarbase64($request->file,'kategori');
            $kategori->gambar	           = $upload['up'];
            $kategori->gambar_path           = $upload['path'];
           }
        $kategori->save();

        return response(['status' => true ,'text'    => 'has update'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();

        return response(['status' => true ,'text'    => 'has delete'], 200);
    }
}
