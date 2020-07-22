<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
        protected $table = 'paragraphs';

        protected $fillable = ['title', 'description', 'image', 'article_id'];
}
