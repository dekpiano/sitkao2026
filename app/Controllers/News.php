<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = new NewsModel();
        $category = $this->request->getVar('category');
        $search   = $this->request->getVar('search');

        $builder = $model;

        if (!empty($category)) {
            $builder = $builder->where('news_category', $category);
        }

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('news_title', $search)
                               ->orLike('news_content', $search)
                               ->groupEnd();
        }

        $newsList = $builder->orderBy('news_date', 'DESC')->orderBy('news_id', 'DESC')->findAll();
        $featured = !empty($newsList) ? $newsList[0] : null;

        $data = [
            'newsList' => $newsList,
            'featured' => $featured,
            'category' => $category,
            'search'   => $search
        ];

        return view('news/index', $data);
    }

    public function detail($id)
    {
        $model = new NewsModel();
        $news = $model->find($id);

        if (!$news) {
            return redirect()->to('/news')->with('error', 'ไม่พบข่าวสารหรือกิจกรรมที่ต้องการ');
        }

        // Increment views count
        $model->update($id, ['news_views' => ($news['news_views'] ?? 0) + 1]);

        $data = [
            'news'        => $news,
            'recentNews'  => $model->where('news_id !=', $id)->orderBy('news_date', 'DESC')->limit(4)->findAll()
        ];

        return view('news/detail', $data);
    }
}
