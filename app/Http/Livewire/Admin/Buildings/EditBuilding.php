<?php

namespace App\Http\Livewire\Admin\Buildings;

use Livewire\Component;
use App\Models\Building;

class EditBuilding extends Component
{
    public $open = false;

    public $building_id;
    public $address = [];
    public $number;
    public $name;
    public $buildingtype;

    protected $listeners = [
        'openEditBuildingModal' => 'openModal',
        'closeEditBuildingModal' => 'closeModal',
    ];

    protected $rules = [
        'address' => 'required|array',
    ];

    public function openModal($buidling_id)
    {
        $building = Building::findOrFail($buidling_id);

        $this->building_id = $building->id;
        $this->address['en'] = $building->getTranslation('address', 'en');
        $this->address['ar'] = $building->getTranslation('address', 'ar');
        $this->number = $building->number;
        $this->name = $building->name;
        $this->buildingtype = $building->buildingtype;

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["address", "number", "building_id","buildingtype","name"]);
    }

    public function updateBuilding()
    {
        $this->validate([
            "address.en" => "required|max:255|string",
            "address.*" => "nullable|max:255|string",
            "number" => "required|string",
            "name" => "required|string",
            "buildingtype" => "required|min:1|integer",
        ]);

        $building = Building::findOrFail($this->building_id);

        $building->update([
            "address" => [
                'en' => $this->address['en'],
                'ar' => $this->address['ar'] ?? $this->address['en'],
            ],
            "number" => $this->number,
            "name" => $this->name,
            "buildingtype" => $this->buildingtype,
        ]);

        $this->emit("success", __('messages.building_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.buildings.edit-building');
    }
}