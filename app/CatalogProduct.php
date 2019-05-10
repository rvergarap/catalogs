<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model
{
    public $table = "catalog_product";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['catalog_id', 'product_id', 'current_stock', 'max_stock'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}