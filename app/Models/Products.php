<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='products';
    protected $fillable = ['name','price','image','description'];
    public function cart(){
        return $this->hasOne('products','product_id','id');
    }
}
