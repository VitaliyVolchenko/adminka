<?php

namespace App\Http\DTO;

class AdminFilter
{
    public string $name;
    public string $email;
    public string $status;

    public function __construct(string $name = '', string $email = '', string $status = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
    }
}
