<?php

namespace App\Store\Shared\Application;

class TestMessage
{
    private $payload;
    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }
    /**
     * @param mixed $payload
     */
    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }
}