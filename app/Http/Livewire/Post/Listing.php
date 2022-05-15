<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Listing extends Component
{
  use WithPagination;
  use LivewireAlert;
  public $action = 'post';
  public $heading = 'Post';
  public $q;
  public $sortBy = 'title';
  public $sortAsc = true;
  public $item;
  public $deleteID = '';

  protected $queryString = [
      'q' => ['except' => ''],
      'sortBy' => ['except' => 'id'],
      'sortAsc' => ['except' => true],
  ];

  public function render() {
    $items = Post::with('Author')->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->when($this->q, function ($query) {
            $query->where('title', 'like', '%' . $this->q . '%');
        });
    $items = $items->paginate(10);
    return view('livewire.'.$this->action.'.listing', [
        'data' => $items,
    ]);
  }

  public function updatingQ() {
    $this->resetPage();
  }

  public function sortBy( $field) {
    if( $field == $this->sortBy) {
        $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }

  public function deleteRecord($id) {
      $this->deleteID = $id;
  }

  public function delete() {
    if( Post::find($this->deleteID)->delete() ) {
      $this->flash('success', 'User has been deleted successfully!');
      return redirect()->route($this->action.'.listing');
    }
  }
}
