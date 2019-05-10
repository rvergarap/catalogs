<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Product;

class Catalog extends Model
{
    public $table = "catalog";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'id_client'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'catalog_product', 'catalog_id',
            'product_id')->withPivot('current_stock', 'max_stock');
    }
}