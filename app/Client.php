<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Catalog;
use Product;

class Client extends Model
{
    public $table = "client";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'rut'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function catalogs()
    {
        return $this->hasMany('App\Catalog', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough('App\CatalogProduct', 'App\Catalog');
    }
}