<?php

namespace App\Traits;

trait isSearching {

    /**
     * @return mixed
     * @internal param array|string $relations
     */
    public function searching() {

        if (request()->ajax() && request()->has('search')) {

            $modelData = $this->where(

                request()->criteria,
                'like',
                '%' . request()->input('search') . '%'

            )->orderBy('name')->paginate(2);

            return $modelData;

        }

        return $this->orderBy('name')->paginate(2);
    }

}