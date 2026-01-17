<?php

namespace App\ValueObjects;

class PageInformationValueObject
{
    public int $statusCode {
        get => $this->statusCode;
        set => $this->statusCode = $value;
    }

    public bool $isSuccessful {
        get => $this->isSuccessful;
        set => $this->isSuccessful = $value;
    }

    public string $url {
        get => $this->url;
        set => $this->url = $value;
    }

    public static function fromData(array $data): self
    {
        $instance = new self();
        $instance->statusCode = $data['statusCode'];
        $instance->url = $data['url'];
        $instance->isSuccessful = $data['isSuccessful'];

        return $instance;
    }
}
