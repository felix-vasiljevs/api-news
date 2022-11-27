<?php

namespace App\Controllers;

class NewsController extends BaseController
{
    public function index(): string
    {
        $defaultNews = "USA";
        $news = $this->getApiKey()->getNews($_GET["search"] ?? $defaultNews);
        $newsReport = $this->getApiKey()->getNews($news);
        return $this->render($newsReport, ['newsReport' => $newsReport, 'news' => $news]);
    }
}