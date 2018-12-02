<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;

class CategorySuggestion extends Model
{
    protected $guarded = ['id'];
    protected $table = 'categories_suggestion';
}
