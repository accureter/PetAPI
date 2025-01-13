<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Enums\PetStatus;

class PetStoreAPIWrapper
{
    private $apiUrl = 'https://petstore.swagger.io/v2/pet/';

    public function addPet(array $petData)
    {
        $response = Http::post($this->apiUrl, $petData);
        return $this->handleResponse($response);
    }

    public function getPet(int $id)
    {
        $response = Http::get($this->apiUrl . $id);
        return $this->handleResponse($response);
    }

    public function updatePet(array $petData)
    {
        $response = Http::put($this->apiUrl, $petData);
        return $this->handleResponse($response);
    }

    public function deletePet(int $id)
    {
        $response = Http::delete($this->apiUrl . $id);
        return $this->handleResponse($response);
    }

    public function getPetsByStatus(PetStatus $status)
    {
        $response = Http::get($this->apiUrl . 'findByStatus', ['status' => $status->value]);
        return $this->handleResponse($response);
    }

    private function handleResponse(Response $response)
    {
        if ($response->failed()) {
            return [
                'success' => false,
                'status' => $response->status(),
                'message' => $response->json()['message'] ?? 'Unknown error',
            ];
        }

        return [
            'success' => true,
            'data' => $response->json(),
        ];
    }
}
