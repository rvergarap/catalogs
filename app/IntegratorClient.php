<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegratorClient extends Model
{
    public $table = "integrator_client";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['integrator_id', 'client_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function clients()
    {
        return $this->hasMany('App\Client', 'id', 'client_id');
    }
}