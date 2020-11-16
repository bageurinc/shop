<?php

namespace Bageur\ecommerce\model;

use Illuminate\Database\Eloquent\Model;
use App\User;
class produk extends Model
{
    protected $table    = 'bgr_produk';
    protected $appends  = ['data_harga','data_variant','data_preorder','data_gambar','satu_gambar','publish'];
    protected $hidden   = [
        'id_user', 'variant', 'harga', 'preorder','gambar1','gambar2','gambar3','gambar4','gambar5','created_at','updated_at'
    ];
    public function getPublishAttribute() {
        if (empty($this->created_at)) {
            return null;
        }
        return $this->created_at->toFormattedDateString();
    }
    public function user()
    {
      return $this->hasOne('App\User','id','id_user');
    }
    public function getDataHargaAttribute() {
       $data = json_decode($this->variant);
       if(!empty($this->variant)){
         $collection = collect($data[0]->list)->sortBy('harga');
         $collection = $collection->firstWhere('harga');

         if((@$data[1]->list) != 0){
           $collection1 = collect($data[1]->list)->sortBy('harga');
           $collection1 = $collection1->firstWhere('harga');
         }

         $harga = 0;
         if(!empty($collection1->harga)){
           if(@$collection1->harga > @$collection->harga){
              $harga = @$collection->harga;
           }else{
              $harga = @$collection1->harga;
           }
         }else{
              $harga = @$collection->harga;
         }
         return @$harga;
       }else{
        return $this->harga;
       }
    }
    public function getDataVariantAttribute() {
       return json_decode($this->variant);
    }
    public function getDataPreorderAttribute() {
       return json_decode($this->preorder);
    }
    public function getSatuGambarAttribute() {
      return url('storage/ecommerce/'.$this->gambar1);
    }
    public function getDataGambarAttribute() {
      $data = [];
      array_push($data, url('storage/ecommerce/'.$this->gambar1));
      if(!empty($this->gambar2)){array_push($data, url('storage/ecommerce/'.$this->gambar2));}
      if(!empty($this->gambar3)){array_push($data, url('storage/ecommerce/'.$this->gambar3));}
      if(!empty($this->gambar4)){array_push($data, url('storage/ecommerce/'.$this->gambar4));}
      if(!empty($this->gambar5)){array_push($data, url('storage/ecommerce/'.$this->gambar5));}
      return $data;
    }
    public function scopeCekproduk($query,$user,$nama_seo){
        $usercek = User::where('username','sesaat');
        if($usercek->count() > 0){
          $query->where('id_user',$usercek->first()->id);
          $query->where('nama_seo',$nama_seo);
          return $query->firstOrFail();
        }else{
            return ['status' => 'error', 'text' => 'username tidak ada'];
        }
    }
    public function scopeDatatable($query,$request,$page=12)
    {

        $search       = ["nama"];
        $searchqry    = '';

        $searchqry = "(";
        foreach ($search as $key => $value) {
            if($key == 0){
                $searchqry .= "lower($value) like '%".strtolower($request->search)."%'";
            }else{
                $searchqry .= "OR lower($value) like '%".strtolower($request->search)."%'";
            }
        } 
        $searchqry .= ")";
        if(isset($request->sort_by)){
            if(!empty(@$request->sort_by)){
              $explode = explode('.', $request->sort_by);
              if(count($explode) == 1){
                return response()->json(['status' => 'error','message'=>'sort salah'],500);
              }else{
                try {
                  $query->orderBy($explode[0],$explode[1]);
                 }catch(\Exception $e){
                  return response()->json(['status' => 'error','message'=> $e->getMessage()],500);
                 }
              }
            }else{
              $query->orderBy('created_at','desc');
            }
             $query->whereRaw($searchqry);
        }else{
             $query->orderBy('created_at','desc');
             $query->whereRaw($searchqry);
        }
        if($request->get == 'all'){
            return $query->get();
        }else{
            return $query->paginate($page);
        }

    }
}
