<?php

namespace App\Traits;

trait hasPagination {

    /**
     * @param $modelData
     * @return array
     */
    public function pagination($modelData): array
    {
        return [

            'total' => $modelData->total(),
            'current_page' => $modelData->currentPage(),
            'per_page' => $modelData->perPage(),
            'last_page' => $modelData->lastPage(),
            'from' => $modelData->firstItem(),
            'to' => $modelData->lastItem(),

        ];
    }

}