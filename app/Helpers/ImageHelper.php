<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class ImageHelper
{
    public static function ImageUpload($table,$image,$column)
    {
        //dd($image);
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $image = 'images/'.$imageName;

        try
        {
            DB::beginTransaction();
           $img = DB::table($table)->update([$column => $image]);
          if($img)
          {
            $response = true;
          }
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            $response = false;
        }
        DB::commit();
        return $response;
    }
}
