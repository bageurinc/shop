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
                        'kategori'            => 'required',
                        'nama'                => 'required',
                        'berat'               => 'required|numeric|min:10',
                        'keterangan'          => 'required',
                        'gambar'              => 'required|mimes:jpg,jpeg,png|max:1000',
                        'gambar_2'            => 'nullable|mimes:jpg,jpeg,png|max:1000',
                    ];
        if(empty($request->variant)){
            $rules ['harga']                  = 'required|numeric|min:100';
        }else{
            $rules ['variant.*.type']           = 'required';
            $rules ['variant.*.list']           = 'required';
            $rules ['variant.*.list.*.nama']    = 'required';
            $rules ['variant.*.list.*.harga']   = 'required|numeric|min:10';
            // $rules ['variant.list.*.stok']   = 'required|numeric';
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
            $upload                     = Helper::go($request->file('gambar'),'ecommerce');
            $produk->id_kategori        = $request->kategori;
            $produk->id_user            = $request->user;
            $produk->nama               = $request->nama;
            $produk->nama_seo           = Str::slug($request->nama);
            if(!empty($request->variant)){
                $produk->variant        = json_encode($request->variant);
            }else{
                $produk->harga          = $request->harga;
            }
            if(!empty($request->preorder)){
                $produk->preorder        = json_encode($request->preorder);
            }
            $produk->berat              = $request->berat;
            $produk->keterangan         = $request->keterangan;
            $produk->gambar1            = $upload;
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
        return slider::findOrFail($id);
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
        $rules      = [];
        if($request->file('gambar') != null){
            $rules['gambar'] = 'mimes:jpg,jpeg,png|max:2000';
        }  
        $messages   = [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $slider                     = slider::findOrFail($id);
            $slider->caption            = $request->caption;
            if($request->file('gambar') != null){
                $upload                     = UploadProcessor::go($request->file('gambar'),'slider');
                $slider->gambar             = $upload;
            }
            $slider->save();
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
          $delete = slider::findOrFail($id);
          $delete->delete();
          return response(['status' => true ,'text'    => 'has deleted'], 200); 
    }

}