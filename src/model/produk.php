<?php

namespace Bageur\ecommerce\model;

use Illuminate\Database\Eloquent\Model;
use App\User;
// use Bageur\Ecommerce\Processors\Helper;

class produk extends Model
{
    protected $table    = 'bgr_produk';
    protected $appends  = ['bintang','avatar','data_harga','data_variant','data_preorder','publish'];
    protected $hidden   = ['id_user', 'harga', 'preorder','created_at','updated_at'];

    public function getPublishAttribute() {
        if (empty($this->created_at)) {
            return null;
        }
        return $this->created_at->toFormattedDateString();
    }
    public function getAvatarAttribute()
    {
      $find   = \Bageur\Ecommerce\model\gambar_produk::where('id_produk',$this->id)->first();
      $gambar = \Bageur::avatar($this->nama,@$find->gambar,@$find->gambar_path);
      return $gambar;
    }
    public function umkm()
    {
      return $this->belongsTo('App\Model\umkm');
    }
    public function kategori()
    {
         return $this->hasOne('Bageur\Ecommerce\model\kategori','id','id_kategori');
    }
    public function review()
    {
      return $this->hasMany('Bageur\Ecommerce\model\review','id_produk');
    }
    public function gambar()
    {
      return $this->hasMany('Bageur\Ecommerce\model\gambar_produk','id_produk','id');
    }
    public function getbintangAttribute()
    {
        $count = $this->review()->count();
        if(empty($count)){
            return 0;
        }
        $starCountSum=$this->review()->sum('rating');
        $average=$starCountSum/ $count;

       return $average;

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

    public function scopeData($query, $request){
        if($request->nama){
            $query->where('nama', 'like', '%'.$request->nama.'%');
        }
        if($request->id_provinsi){
            $query->whereHas('umkm', function($query) use ($request){
                $query->where('id_provinsi', $request->id_provinsi);
            });
        }
        if($request->id_kota){
            $query->whereHas('umkm', function($query) use ($request){
                $query->where('id_kota', $request->id_kota);
            });
        }

        return $query;
    }
    public function scopeFilter($query, $request){

        if($request->id_kategori){
            $query->where('id_kategori', $request->id_kategori);
        }
        if($request->id_provinsi){
            $query->whereHas('umkm', function($query) use ($request){
                $query->where('id_provinsi', $request->id_provinsi);
            });
        }
        if($request->bintang){
            $query->whereHas('review', function($query) use ($request){
                $query->where('rating', $request->bintang);
            });
        }
        if($request->harga1){
            $query->where('harga_jual', '>=' ,$request->harga1);
        }
        if($request->harga2){
            $query->where('harga_jual', '<=' ,$request->harga2);
        }
        if($request->variant){
            $query->where('variant->nama', $request->variant);
        }
        return $query;
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
    public function scopeCariKategori($query,$request){
      if($request->id_kategori != null){
       $query->where('bgr_produk.id_kategori',$request->id_kategori);
      }
    }
    public function scopeCariKota($query,$request){
        $kota = explode(',',$request->get('kota'));
        $provinsi = explode(',',$request->get('provinsi'));
        if($request->get('provinsi') != null  && $request->get('kota') == null){
          $query->whereIn('umkm.id_provinsi',$provinsi);
        } else if($request->get('kota') != null){
          $query->whereIn('umkm.id_kota',$kota);
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
