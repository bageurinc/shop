<?php
namespace Bageur\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bageur\Ecommerce\processors\Helper;
use Bageur\Ecommerce\model\gambar_produk;
use Validator;
class GambarProdukCmsController extends Controller
{

    public function index(Request $request)
    {
       $query = gambar_produk::datatable($request);
       return $query;
    }

    public function store(Request $request)
    {
        $rules    	= [
                        'gambar.*'		     		=> 'required|mimes:jpg,jpeg,png|max:2000',
                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{

           $gambar = $request->file('gambar');
           for ($i=0; $i < count($gambar); $i++) {
                $upload                            = Helper::avatarbase64($gambar[$i],'produk');
                $gambar_produk                     = new gambar_produk;
                $gambar_produk->id_produk          = $request->id_produk;
                $gambar_produk->gambar             = $upload['up'];
                $gambar_produk->gambar_path        = $upload['path'];
                $gambar_produk->save();
           }
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
        return gambar_produk::findOrFail($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $delete = gambar_produk::findOrFail($id);
          $delete->delete();
          return response(['status' => true ,'text'    => 'has deleted'], 200);
    }

}
