<?php

namespace App\Http\Traits;

trait LoadMoreTrait
{
    public $perPage = 10;

    public function loadMore()
    {
        $this->perPage += 4;
    }
}
