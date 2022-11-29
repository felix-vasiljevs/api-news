<?php

namespace App\Models\Collections;

use App\Models\Article;

class ArticlesCollections
{
    public array $articles = [];

    public function __construct(array $articles = [])
    {
        foreach ($articles as $article) {
            $this->add($article);
        }
    }

    public function add(Article $article): void
    {
        $this->articles []= $article;
    }

    public function get(): array
    {
        return $this->articles;
    }
}