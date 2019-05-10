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
    protected $fillable = ['id_integrator', 'id_client'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}