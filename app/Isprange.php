<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isprange extends Model
{
    protected $fillable = ['isp', 'netmask', 'subnet'];
}
