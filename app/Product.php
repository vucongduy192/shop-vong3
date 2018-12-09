<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'category_id', 'description', 'price', 'quantity', 'img1', 'img2', 'img3'];
    /**
     * @param   $image
     * @param   string $old_image
     * @return  string
     */
    public static function createImage($image, $old_image = "default.png")
    {
        if(!empty($image) && substr($image->getMimeType(), 0, 5) == 'image'){
            $img = $image->getClientOriginalName();
            $thumbnail = Image::make($image->getRealPath())->resize(500, 500);
            $thumbnail->save('images/products/' . strtotime("now") . $img);
            $avatar = strtotime("now") . $img;
            return $avatar;
        }
        return $old_image;
    }
}

