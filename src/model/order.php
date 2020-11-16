<?php

namespace Bageur\ecommerce\model;
use Illuminate\Database\Eloquent\Model;
class order extends Model
{
    protected $table    = 'bgr_order';
    protected $appends  = ['data_produk','avatar','total'];
   	public function getDataProdukAttribute() {
       return json_decode($this->produk,true);
    }   	

    public function getAvatarAttribute() {
       return avatar($this->nama);
    }

    public function getTotalAttribute() {
       return ($this->harga*$this->qty)+$this->kurir_cost;
    }

    public function data_kota()
    {
      return $this->hasOne('Bageur\Ecommerce\model\kota','city_id','kota');
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
