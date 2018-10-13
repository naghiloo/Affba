<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['link', 'ip', 'os', 'browser', 'country' ,'resolution'];

    // Relation To Link Table
    public function link(){
    	return $this->belongsTo(Link::class, 'link');
    }
}
