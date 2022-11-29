<?php

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private ?string $author;
    private string $title;
    private string $description;
    private string $url;
    private ?string $urlToImage;
    private string $publishedAt;

    public function __construct(
        ?string $author,
        string $title,
        string $description,
        string $url,
        ?string $urlToImage,
        string $publishedAt
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->publishedAt = $publishedAt;
        $this->author = $author;
    }

    public function getAuthor(): ?string
    {
        if ($this->author === null) {
            return 'Unknown Author';
        }
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
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
        $image = $this->urlToImage;

        if ($image === null) {
            return '/public/images/no-image.jpg';
        }
        return $image;
    }

    public function getPublishedAt(): string
    {
        return Carbon::createFromDate($this->publishedAt)->format('Y-m-d');
    }
}