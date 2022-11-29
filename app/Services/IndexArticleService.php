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
        $this->apiKey = new NewsApi("ea1353833dfe45658d0fe2c3f7c77a9c");
    }

    public function execute(string $search, ?string $category = null): ArticlesCollections
    {
        $articlesApiResponse = $this->getArticles($search, $category);

        $articles = new ArticlesCollections();

        foreach ($articlesApiResponse->articles as $article) {
            $articles->add(new Article(
                $article->author,
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage,
                $article->publishedAt
            ));
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