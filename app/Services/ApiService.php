<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class ApiService
{

    public function data() {

        $api['host'] = config('services.rapid_api.host');

        $api['key'] = config('services.rapid_api.key');

        return $api;
    }

    public function search($query) {

        $url = $this->data()['host'] . '/search/' . $query;

        $request = Http::withHeaders(['x-rapidapi-key' => $this->data()['key']])
            ->get($url);

        $results = json_decode($request);

        return $results;
    }

    public function find($id) {

        $url = $this->data()['host'] . '/film/' . $id;

        $request = Http::withHeaders(['x-rapidapi-key' => $this->data()['key']])
            ->get($url);

        $result = json_decode($request);

        return $result;
    }
}
