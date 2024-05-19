<?php

namespace App\Service\Common;

interface AggregateInterface
{
    public function fetchPosts(): array;
}