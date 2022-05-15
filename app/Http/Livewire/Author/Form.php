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
      /*$response = Http::withToken('d16569a6816e7171c4cf6df776768b80b4a609ebaab8b6de412dfd16852e03da')->post('https://gorest.co.in/public/v2/users', [
          'name' => 'Sara',
          'email' => 'sara@example.com',
          'status' => 'active',
          'gender' => 'female'
      ]);
      print_r($response); die;*/

      if($id) {
        $row = Author::findOrfail($id);
        $this->fill([
          'edit' => true,
          'modifyId' => $id,
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
        }
        if( $result ) {
          $this->flash('success', 'User has been saved successfully!');
          return redirect()->route($this->action.'.listing');
        }
    }
}
