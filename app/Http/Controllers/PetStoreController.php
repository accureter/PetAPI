<?php

namespace App\Http\Controllers;

use App\Enums\PetStatus;
use App\Services\PetStoreAPIWrapper;
use Illuminate\Http\Request;

class PetStoreController extends Controller
{
    private $petStoreAPI;

    public function __construct(PetStoreAPIWrapper $petStoreAPI)
    {
        $this->petStoreAPI = $petStoreAPI;
    }

    public function getPetsByStatus(Request $request)
    {
        $status = $request->input('status', 'available');
        $pets = $this->petStoreAPI->getPetsByStatus(PetStatus::from($status));
        return view('pets.index', [
            'pets' => $pets['data'] ?? [],
            'status' => $status,
        ]);
    }

    public function addPet(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string|in:available,pending,sold',
        ]);
        $petData = $request->all();
        $response = $this->petStoreAPI->addPet($petData);
        if (!isset($response['success'])) {

            return redirect()->route('pets.index')->withErrors($response['message']);
        }
        return redirect()->route('pets.show', ['id' => $response['data']['id']])->with('success', 'Pet added successfully');
    }

    public function renderAddPet()
    {
        return view('pets.add');
    }

    public function getPet(int $id)
    {
        $pet = $this->petStoreAPI->getPet($id);
        return view('pets.show', ['pet' => $pet['data'] ?? []]);
    }

    public function renderEditPet(int $id)
    {
        $pet = $this->petStoreAPI->getPet($id);
        return view('pets.edit', ['pet' => $pet['data'] ?? []]);
    }

    public function updatePet(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string|in:available,pending,sold',
        ]);
        $petData = $request->all();
        $petData['id'] = $id;
        $response = $this->petStoreAPI->updatePet($petData);
        if (!isset($response['success'])) {
            return redirect()->route('pets.index')->withErrors($response['message']);
        }
        return redirect()->route('pets.show', ['id' => $response['data']['id']])->with('success', 'Pet updated successfully');
    }

    public function deletePet(int $id)
    {
        $response = $this->petStoreAPI->deletePet($id);
        if (!isset($response['success'])) {
            return redirect()->route('pets.index')->withErrors($response['message']);
        }
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
    }
}
