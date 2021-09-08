<?php

class Response
{
    public function __construct(private string $code, private string | array $content)
    {
        
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function __toString()
    {
        http_response_code($this->code);
        return is_array($this->content) ? json_encode($this->content) : $this->content;
    }
}