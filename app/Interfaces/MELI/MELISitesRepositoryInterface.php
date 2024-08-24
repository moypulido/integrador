<?php

namespace App\Interfaces\MELI;

interface MELISitesRepositoryInterface
{
    public function getItemsbyUser($sort = null, $filters = []);
}
