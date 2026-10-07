<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table      = 'tb_news';
    protected $primaryKey = 'news_id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'news_title',
        'news_category',
        'news_content',
        'news_image',
        'news_date',
        'news_author_id',
        'news_views'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'news_created_at';
    protected $updatedField  = 'news_updated_at';
}
