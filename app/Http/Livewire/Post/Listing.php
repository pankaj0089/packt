<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Listing extends Component
{
  use WithPagination;
  public $action = 'post';
  public $heading = 'Post';
  public $q;
  public $sortBy = 'id';
  public $sortAsc = true;
  public $item;

  protected $queryString = [
      'q' => ['except' => ''],
      'sortBy' => ['except' => 'id'],
      'sortAsc' => ['except' => true],
  ];

  public function render() {
    $items = Post::orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
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
}
