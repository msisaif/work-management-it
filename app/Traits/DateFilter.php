<?php

namespace App\Traits;

trait DateFilter
{
    public function dateFilter()
    {
        $this->getQuery()
            ->when(request()->from, function ($query, $date_from) {
                $query->whereDate('created_at', '>=', $date_from);
            })
            ->when(request()->to, function ($query, $date_to) {
                $query->whereDate('created_at', '<=', $date_to);
            });

        return $this;
    }
}