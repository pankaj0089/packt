<?php

namespace App\Http\Livewire\Author;
use Livewire\Component;
use App\Models\Author;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;
    public $action = 'author';
    public $heading = 'Author';
    public $edit = false;
    public $name;
    public $email;
    public $gender;
    public $address_line1;
    public $address_line2;
    public $city;
    public $country_id = 1;
    public $status = 1;
    public $modifyId;
    public $goRestId;
    public $restMsg = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'gender' => 'required|not_in:0',
        'address_line1' => 'required',
        'city' => 'required',
        'country_id' => 'required',
    ];

    public function mount($id = '')
    {
      if($id) {
        $row = Author::findOrfail($id);
        $this->fill([
          'edit' => true,
          'modifyId' => $id,
          'goRestId' => $row->rest_user_id,
          'name' => $row->name,
          'email' => $row->email,
          'address_line1' => $row->address_line1,
          'address_line2' => $row->address_line2,
          'address' => $row->address,
          'city' => $row->city,
          'country_id' => $row->country_id,
          'gender' => $row->gender,
          'status' => $row->status
        ]);
      }
    }
    public function render()
    {
      return view('livewire.'.$this->action.'.form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveData()
    {
        $validatedData = $this->validate();
        $validatedData['address_line2'] = $this->address_line2;
        $validatedData['status'] = $this->status;
        if($this->edit) {
          $result = Author::findOrfail($this->modifyId)->update($validatedData);
        } else {
          $result = Author::create($validatedData);
          $this->modifyId = $result->id;
        }
        if($this->modifyId > 0) {
          $this->restMsg = $this->syncRecord();
        }
        if( $result ) {
          $this->flash('success', 'User has been saved successfully! <br />'.$this->restMsg);
          return redirect()->route($this->action.'.listing');
        }
    }

    private function syncRecord() {
      $dataArray = [
          'name' => $this->name,
          'email' => $this->email,
          'status' => $this->status ? 'active' : 'inactive',
          'gender' => $this->gender,
      ];
      $apiUrl = env('REST_API_URL').'users/';
      if($this->edit && $this->goRestId > 0) {
        $response = Http::withToken(env('REST_API_TOKEN'))
          ->put($apiUrl.$this->goRestId, $dataArray);
      } else {
        $response = Http::withToken(env('REST_API_TOKEN'))
          ->post($apiUrl, $dataArray);
      }
      switch ($response->status()) {
        case 200:
            $msg = "User updated in GoRest API.";
            break;
        case 201:
            $responseObj = json_decode($response->body());
            $result = Author::findOrfail($this->modifyId)->update(['rest_user_id' => $responseObj->id]);
            $msg = "User added to GoRest API";
            break;
        case 422:
            $msg = 'Email ID is already registered with GoRest API';
            break;
        default:
            $msg = "Unable to sync record with GoRest API!";
            break;
      }
      return $msg;
    }
}
