<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

}
