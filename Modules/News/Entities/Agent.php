<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];

    public function news()
    {
        return $this->hasMany(News::class,'agent_id','id');
    }
}
