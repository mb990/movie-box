<?php


namespace App\Services;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationService
{
    public function paginate($data, $perPage, $page = null, $options = []) {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $data = $data instanceof Collection ? $data : Collection::make($data);

        return new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage, $page, $options);
    }
}
