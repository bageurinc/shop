<?php
namespace Bageur\ecommerce\Processors;

class Helper {

    public static function go($data,$loc) {
       $namaBerkas = date('YmdHis').'.'.$data->getClientOriginalExtension();
       $path = $data->storeAs('public/'.$loc.'/', $namaBerkas);
       return basename($path);
    }

     function avatar( $name, $image = null, $folder = "sesaat", $type = "initials") {
        if (empty($image)) {
            if (!empty($name)) {
                return 'https://avatars.dicebear.com/v2/'.$type.'/' . preg_replace('/[^a-z0-9 _.-]+/i', '', $name) . '.svg?options[radius]=50';
            }
            return null;
        }
        return url('storage/'.$folder.'/'.$image);
    }
}
