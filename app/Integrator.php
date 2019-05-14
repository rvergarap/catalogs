<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrator extends Model
{
    public $table = "integrator";

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

    public function clients()
    {
        return $this->belongsToMany('App\Client','integrator_client');
    }
}