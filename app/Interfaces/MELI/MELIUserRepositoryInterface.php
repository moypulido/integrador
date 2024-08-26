<?php

// app/Interfaces/MELI/userRepositoryInterface.php
namespace App\Interfaces\MELI;

interface MELIUserRepositoryInterface
{
    public function getUserMe();

    public function getItems($sort = null, $filters = [], $limit = 10, $offset = 0);
}
