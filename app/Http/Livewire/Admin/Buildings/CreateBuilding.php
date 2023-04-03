<?php

namespace App\Http\Livewire\Admin\Buildings;

use App\Models\Apartment;
use App\Models\Building;
use Livewire\Component;

class CreateBuilding extends Component
{
    public $open = false;

    public $address = [];
    public $number;
    public $name;
    public $buildingtype;
    public $floors;
    public $apartments_on_floor;
    public $basement = false;

    protected $listeners = [
        'openCreateBuildingModal' => 'openModal',
        'closeCreateBuildingModal' => 'closeModal',
    ];

    protected $rules = [
        'address' => 'required|array',
    ];

    public function openModal()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["address", "number","buildingtype","name", "floors", "apartments_on_floor", "basement",]);
    }

    public function storeBuilding()
    {
       
        
       
        $this->validate([
            "address.en" => "required|max:255|string",
            "address.*" => "nullable|max:255|string",
            "name" => "required|string",
            "number" => "required|string",
            "buildingtype" => "required|min:1|integer",
            "floors" => "required|min:1|integer",
            "apartments_on_floor" => "required|min:1|integer",
            "basement" => "nullable|boolean"
        ]);

        $building = Building::create([
            "address" => [
                'en' => $this->address['en'],
                'ar' => $this->address['ar'] ?? $this->address['en'],
            ],
            "name" => $this->name,
            "number" => $this->number,
            "buildingtype" => $this->buildingtype,
            "image" => "images/buildings/".$this->buildingtype ."/". $this->name ."/buildinglogo.png",
        ]);

        $apartments = [];

        if ($this->basement) {
                $apartments[] = new Apartment([
                'floor' => 0,
                'number' => 1,
            ]);
        }

        foreach (range(1, $this->floors) as $floor) {
            foreach (range(1, $this->apartments_on_floor) as $apartment) {
                $apartments[] = new Apartment([
                    'floor' => $floor,
                    'number' => $apartment,
                    'image' => 'images\appartments'. $this->address['en'] . $apartment,
                    'appartmenttype' => 1,
                ]);
            }
        }

        $building->apartments()->saveMany($apartments);
 
        $this->CreateBuildingImage();
        $this->closeModal();
        $this->emit("success", __('messages.building_created'));
    }
public function CreateBuildingImage(){
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/public/"."images/buildings/buildinglogo.png";
    $folder_full = $_SERVER['DOCUMENT_ROOT']."/public/"."images/buildings/".$this->buildingtype ."/". $this->name;
    if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);
    $newPath = $folder_full ."/";
    $ext = '.png';
    $newName  = $newPath."buildinglogo".$ext;
    $copied = copy($imagePath , $newName);
}
    public function render()
    {
        return view('livewire-components.admin.buildings.create-building');
    }
}