<?php

namespace App\Repositories\Interfaces;

interface UserInterface
{
    public function signup($request);

    public function profileUpdate($request);
}
