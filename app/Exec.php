<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exec extends Model
{

protected $table = 'exec';
    
public function user()
	{ 
	    return $this->belongsTo('App\User');
	}
}
