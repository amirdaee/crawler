<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;

class CrawlTask extends Model
{
    protected $table = 'crawl_tasks';
    protected $guarded = [];

    public function news()
    {
        return $this->hasOne(News::class,'crawl_task_id','id');
    }
}
