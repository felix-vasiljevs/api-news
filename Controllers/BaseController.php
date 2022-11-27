<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use app\ApiClient;

class BaseController
{
    private FilesystemLoader $loader;
    private Environment $environment;
    private ApiClient $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient($_ENV["WEATHER_API_KEY"]);
        $this->loader = new FilesystemLoader('.env');
        $this->environment = new Environment($this->loader);
    }

    public function render (string $template, array $context = []): string
    {
        return $this->render($template, $context);
    }

    public function getApiKey(): ApiClient
    {
        return $this->getApiKey();
    }
}

