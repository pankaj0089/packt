<?php

namespace App\Http\Livewire\Post;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Trix;

class Form extends Component
{
    use LivewireAlert;
    public $action = 'post';
    public $heading = 'Post';
    public $edit = false;
    public $title;
    public $body;
    public $author_id;
    public $modifyId;

    protected $rules = [
        'title' => 'required|max:255',
        'body' => 'required',
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
        $row = Post::findOrfail($id);
        $this->fill([
          'edit' => true,
          'modifyId' => $id,
          'title' => $row->title,
          'body' => $row->body,
        ]);
      }
    }
    public function render()
    {
      return view('livewire.'.$this->action.'.form');
    }

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trix_value_updated($value){
        $this->body = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveData()
    {
        $validatedData = $this->validate();
        if($this->edit) {
          $result = Post::findOrfail($this->modifyId)->update($validatedData);
        } else {
          $result = Post::create($validatedData);
        }
        if( $result ) {
          $this->flash('success', 'Post has been saved successfully!');
          return redirect()->route($this->action.'.listing');
        }
    }
}
