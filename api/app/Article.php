<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $guarded = ['title'];

    /**
     * Get the paragraphs for the article.
     */
    public function paragraphs()
    {
        return $this->hasMany('App\Paragraph');
    }
}
