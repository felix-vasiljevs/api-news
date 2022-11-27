<?php

namespace App\Models;

class Article
{
    private ?string $author;
    private string $description;
    private string $url;
    private ?string $urlToImage;
    private string $publishedAt;

    public function __construct(

        ?string $author = null,
        string $description,
        string $url,
        ?string $urlToImage = null,
        string $publishedAt
    )
    {
        $this->author = $author;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->publishedAt = $publishedAt;
    }


    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlToImage(): ?string
    {
        return $this->urlToImage;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }
}