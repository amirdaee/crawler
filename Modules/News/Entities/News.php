<?php

namespace Modules\News\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function crawlTask()
    {
        return $this->belongsTo(CrawlTask::class,'crawl_task_id','id');
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class,'agent_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_news','news_id','category_id');
    }
}
