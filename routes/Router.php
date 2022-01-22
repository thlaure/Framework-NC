<?php

namespace Router;

class Router
{
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function show()
    {
        echo $this->url;
    }
}