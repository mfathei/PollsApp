<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['options'];

    public function stats(){
        return $this->hasMany(Stat::class);
    }

    public function getOptionsAttribute(){
        return array_flatten($this->stats()->get(['option'])->toArray());
    }
}
