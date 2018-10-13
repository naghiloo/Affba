<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'shortLink';
    protected $fillable = ['longLink', 'shortLink', 'owner', 'title'];

    // Relation To User Table
    public function user(){
    	return $this->belongsTo(User::class);
    }
    // Relation To View Table
    public function views(){
    	return $this->hasMany(View::class);
    }
}