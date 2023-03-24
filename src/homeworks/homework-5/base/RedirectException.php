<?php

namespace Base;

class RedirectException extends \Exception
{
    private $url;

    public function __consruct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
