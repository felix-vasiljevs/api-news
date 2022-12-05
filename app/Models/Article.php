<?php

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private string $title;
    private string $description;
    private string $url;
    private string $publishedAt;
    private ?string $author;
    private ?string $urlToImage;

    public function __construct(
        string $title,
        string $description,
        string $url,
        string $publishedAt,
        ?string $author,
        ?string $urlToImage
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->author = $author;
        $this->publishedAt = $publishedAt;
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

    public function getPublishedAt(): string
    {
        return Carbon::createFromDate($this->publishedAt)->format('Y-m-d');
    }

    public function getAuthor(): ?string
    {
        if ($this->author === null) {
            return 'Unknown Author';
        }
        return $this->author;
    }

    public function getUrlToImage(): ?string
    {
        $image = $this->urlToImage;

        if ($image === null) {
            return '/public/images/no-image.jpg';
        }
        return $image;
    }
}