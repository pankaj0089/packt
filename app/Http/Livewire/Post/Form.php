<?php

namespace App\Http\Livewire\Post;
use Livewire\Component;
use App\Models\Post;
use App\Models\Author;
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
    public $goRestPostId;
    public $goRestUserId;
    public $restMsg = '';

    protected $rules = [
        'title' => 'required|max:255',
        'body' => 'required',
        'author_id' => 'required|not_in:0'
    ];

    public function mount($id = '')
    {
    /*echo  $apiUrl = env('REST_API_URL').'6219/posts';

$dataArray = [
    'title' => 'ABC',
    'body' => 'BODDYYD'
];
        $response = Http::withToken(env('REST_API_TOKEN'))
          ->post($apiUrl, $dataArray);
    echo $response->status();
    print_r($response->body());
      die;*/
      if($id) {
        $row = Post::findOrfail($id);
        $this->fill([
          'edit' => true,
          'modifyId' => $id,
          'author_id' => $row->author->id,
          'goRestUserId' => $row->author->rest_user_id,
          'goRestPostId' => $row->rest_post_id,
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
        Trix::EVENT_VALUE_UPDATED, // trix_value_updated(),
        'authorUpdated'
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
        //print_r($validatedData); die;
        if($this->edit) {
          $result = Post::findOrfail($this->modifyId)->update($validatedData);
        } else {
          $result = Post::create($validatedData);
          $this->modifyId = $result->id;
        }
        if($this->modifyId > 0) {
          $this->restMsg = $this->syncRecord();
        }
        if( $result ) {
          $this->flash('success', 'Post has been saved successfully!<br />'.$this->restMsg);
          return redirect()->route($this->action.'.listing');
        }
    }

    public function authorUpdated() {
      $this->goRestUserId = Author::where('id', $this->author_id)->pluck('rest_user_id')->first();
    }

    private function syncRecord() {
      $dataArray = [
          'title' => $this->title,
          'body' => $this->body,
          'user_id' => $this->goRestUserId,
      ];
      $apiUrl = env('REST_API_URL').'users/'.$this->goRestUserId.'/posts/';
      if($this->edit && $this->goRestPostId > 0) {
        $apiUrl = env('REST_API_URL').'posts/'.$this->goRestPostId;
        $response = Http::withToken(env('REST_API_TOKEN'))
          ->put($apiUrl, $dataArray);
      } else {
        $response = Http::withToken(env('REST_API_TOKEN'))
          ->post($apiUrl, $dataArray);
      }
      switch ($response->status()) {
        case 200:
            $msg = "Post updated in GoRest API.";
            break;
        case 201:
            $responseObj = json_decode($response->body());
            $result = Post::findOrfail($this->modifyId)->update(['rest_post_id' => $responseObj->id]);
            $msg = "Post added to GoRest API";
            break;
        default:
            $msg = "Unable to sync record with GoRest API!";
            break;
      }
      return $msg;
    }
}
