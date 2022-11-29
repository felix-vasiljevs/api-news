<?php

namespace App\Controllers;

use App\Services\IndexArticleService;
use App\Template;

class ArticleController
{
    public function index(): Template
    {
        $search = $_GET["search"] ?? "Tesla";

        $category = $_GET["category"] ?? null;

        $articles = (new IndexArticleService())->execute($search, $category);

        return new Template(
            'articles/index.html.twig',
            [
                'articles' => $articles->get()
            ]
        );
    }
}