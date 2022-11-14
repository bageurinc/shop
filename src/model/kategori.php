<?php

namespace Bageur\ecommerce\model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bageur\Ecommerce\processors\Helper;
class kategori extends Model
{
  use SoftDeletes;

    protected $table    = 'bgr_kategori_produk';
    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
      $gambar = \Bageur::avatar($this->nama,@$this->gambar,@$this->gambar_path);
      return $gambar;
    }
    // public function produk()
    // {
    //   return $this->hasMany('Bageur\Ecommerce\model\produk','id_kategori','id')->with(['umkm','review']);
    // }
    public function sub()
    {
      return $this->hasMany('Bageur\Ecommerce\model\kategori','sub_id');
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
