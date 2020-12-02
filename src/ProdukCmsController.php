<?php
namespace Bageur\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bageur\Ecommerce\processors\Helper;
use Bageur\Ecommerce\model\produk;
use Validator;
class ProdukCmsController extends Controller
{

    public function index(Request $request)
    {
       $query = produk::datatable($request);
       return $query;
    }

    public function store(Request $request)
    {
        $rules    	= [
                        // 'kategori'            => 'required',
                        // 'nama'                => 'required',
                        // 'berat'               => 'required|numeric|min:100',
                        // 'keterangan'          => 'required',
                        'file'		     	=> 'nullable|base64image|base64max:1000',

                    ];
        if(empty($request->variant)){
            $rules ['harga_jual']                  = 'required|numeric|min:100';
        }else{
            $rules ['variant.*.nama']    = 'required';
            $rules ['variant.*.harga']   = 'required|numeric|min:10';
            $rules ['variant.*.stok']   = 'required|numeric';
        }
        if(!empty($request->preorder)){
            $rules ['preorder.hari']           = 'required|numeric';
            $rules ['preorder.waktu']           = 'required';
        }
        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $produk              		= new produk;
            $produk->id_kategori        = $request->kategori;
            $produk->id_sub_kategori    = $request->subkategori;
            $produk->umkm_id            = $request->umkm;
            $produk->nama               = $request->nama;
            $produk->nama_seo           = Str::slug($request->nama);
            if(!empty($request->variant)){
                $produk->variant        = json_encode($request->variant);
            }else{
                $produk->harga_jual          = $request->harga_jual;
            }
            if(!empty($request->preorder)){
                $produk->preorder        = json_encode($request->preorder);
            }
            $produk->berat              = $request->berat;
            $produk->keterangan         = $request->keterangan;
            // $produk->gambar1            = $upload;
            if($request->file != null){
                $upload                = Helper::avatarbase64($request->file,'produk');
	           	$produk->gambar1	           = $upload['up'];
                $produk->gambar_path           = $upload['path'];
       		}
            if($request->file2 != null){
                $upload                   = Helper::go($request->file2,'produk');
                $produk->gambar2          = $upload['up'];
            }
            if($request->file3 != null){
                $upload                   = Helper::go($request->file3,'produk');
                $produk->gambar3          = $upload['up'];
            }
            if($request->file4 != null){
                $upload                   = Helper::go($request->file4,'produk');
                $produk->gambar4          = $upload['up'];
            }
            if($request->file5 != null){
                $upload                   = Helper::go($request->file4,'produk');
                $produk->gambar5          = $upload['up'];
            }
            return $produk;

               $produk->save();
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
        return produk::findOrFail($id);
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
                        'kategori'            => 'required',
                        'nama'                => 'required',
                        'berat'               => 'required|numeric|min:1',
                        'keterangan'          => 'required',
                        // 'gambar'              => 'required|mimes:jpg,jpeg,png|max:1000',
                        // 'gambar_2'            => 'nullable|mimes:jpg,jpeg,png|max:1000',
                    ];
        if(empty($request->variant)){
            $rules ['harga_jual']                  = 'required|numeric|min:100';
        }else{
            $rules ['variant.*.type']           = 'required';
            $rules ['variant.*.list']           = 'required';
            $rules ['variant.*.list.*.nama']    = 'required';
            $rules ['variant.*.list.*.harga']   = 'required|numeric|min:10';
            $rules ['variant.list.*.stok']   = 'required|numeric';
        }
        if(!empty($request->preorder)){
            $rules ['preorder.hari']           = 'required|numeric';
            $rules ['preorder.waktu']           = 'required';
        }
        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $produk                     = produk::findOrFail($id);
            $produk->id_kategori        = $request->kategori;
            $produk->id_sub_kategori    = $request->subkategori;
            $produk->umkm_id            = $request->umkm;
            $produk->nama               = $request->nama;
            $produk->nama_seo           = Str::slug($request->nama);
            if(!empty($request->variant)){
                $produk->variant        = json_encode($request->variant);
            }else{
                $produk->harga_jual          = $request->harga_jual;
            }
            if(!empty($request->preorder)){
                $produk->preorder        = json_encode($request->preorder);
            }
            $produk->berat              = $request->berat;
            $produk->keterangan         = $request->keterangan;
            // $produk->gambar1            = $upload;
            if($request->file != null){
                $upload                = Helper::avatarbase64($request->file,'produk');
	           	$produk->gambar1	           = $upload['up'];
                $produk->gambar_path           = $upload['path'];
       		}
            if($request->file2 != null){
                $upload                   = Helper::avatarbase64($request->file2,'produk');
                $produk->gambar2          = $upload['up'];
            }
            if($request->file3 != null){
                $upload                   = Helper::avatarbase64($request->file3,'produk');
                $produk->gambar3          = $upload['up'];
            }
            if($request->file4 != null){
                $upload                   = Helper::avatarbase64($request->file4,'produk');
                $produk->gambar4          = $upload['up'];
            }
            if($request->file5 != null){
                $upload                   = Helper::avatarbase64($request->file4,'produk');
                $produk->gambar5          = $upload['up'];
            }
            $produk->save();
            return response(['status' => true ,'text'    => 'has input'], 200);
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
          $delete = produk::findOrFail($id);
          $delete->delete();
          return response(['status' => true ,'text'    => 'has deleted'], 200);
    }

}
