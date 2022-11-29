<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Database\Eloquent\softDeletes;
class Product extends Model
{
    use HasFactory;
    use softDeletes;
    protected $dates = ["deleted_at"];
    public function image(){
        return $this->hasMany(Image::class);
    }
}
