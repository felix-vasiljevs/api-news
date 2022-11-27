<?php

namespace App;

use app\Models\Article;
use app\Controllers\BaseController;
use jcobhams\NewsApi\NewsApi;

class ApiClient
{
    private NewsApi $newsApi;
    private string $apiKey;
    private const API_URL = "https://newsapi.org/v2/";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getNews(string $searchBar): ?Article
    {
        $newsResponse = file_get_contents(self::API_URL . "everything?q={$searchBar}&apiKey={$this->apiKey}");
        $data = json_decode($newsResponse, true);

        return new Article(
            $data["articles"]["author"] ?? 0,
            $data["articles"]["description"] ?? 0,
            $data["articles"]["url"] ?? 0,
            $data["articles"]["urlToImage"] ?? 0,
            $data["articles"]["publishedAt"] ?? 0
        );
    }

    public function getNewsApi(): NewsApi
    {
        return $this->newsApi;
    }
}