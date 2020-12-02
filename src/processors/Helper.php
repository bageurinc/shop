<?php
namespace Bageur\ecommerce\Processors;

class Helper {

    public static function go($data,$loc) {
        $namaBerkas = rand(000,999).'-'.$data->getClientOriginalName();
       \Storage::makeDirectory('public/bageur.id');
        $path = $data->storeAs('public/bageur.id/'.$loc.'/', $namaBerkas);
        return basename($path);
     }

     public static function avatarbase64($data,$loc)
     {
       $path       = 'bageur.id/'.$loc;
       \Storage::makeDirectory('public/'.$path);
       $namaBerkas = 'avatar'.rand(000,999).'.png';
       $image = \Image::make($data);
       $image->save(storage_path('app/public/'.$path.'/'.$namaBerkas));
       $arr = ['up' => $namaBerkas , 'path' => $path];
       return $arr;
     }

      public static function get( $name, $image = null, $folder = "bageur.id/company", $type = "initials") {
         if (empty($image)) {
             if (!empty($name)) {
                 return 'https://avatars.dicebear.com/v2/'.$type.'/' . preg_replace('/[^a-z0-9 _.-]+/i', '', $name) . '.svg';
             }
             return null;
         }
         return url('storage/'.$folder.'/'.$image);
     }
}
