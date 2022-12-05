<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticlesCollections;
use jcobhams\NewsApi\NewsApi;

class IndexArticleService
{
    private NewsApi $apiKey;

    public function __construct()
    {
        $this->apiKey = new NewsApi($_ENV["API_KEY"]);
    }

    public function execute(string $search, ?string $category = null): ArticlesCollections
    {
        $articlesApiResponse = $this->getArticles($search, $category);

        $articles = new ArticlesCollections();
        $count = 0;
        foreach ($articlesApiResponse->articles as $article) {
            if ($count < 15) {
                $articles->add(new Article(
                    $article->author,
                    $article->title,
                    $article->description,
                    $article->url,
                    $article->urlToImage,
                    $article->publishedAt
                ));
            }
            $count++;
        }
        return $articles;
    }

    private function getArticles(string $search, ?string $category = null)
    {
        if (!$category) {
            return $this->apiKey->getEverything($search);
        }
        return $this->apiKey->getTopHeadLines($category);
    }
}