<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
