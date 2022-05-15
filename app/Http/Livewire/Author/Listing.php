<?php

namespace App\Http\Livewire\Author;

use Livewire\Component;
use App\Models\Author;
use Livewire\WithPagination;
use Session;

class Listing extends Component
{
  use WithPagination;
  public $action = 'author';
  public $heading = 'Author';
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
    $items = Author::with('country')->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->when($this->q, function ($query) {
            $query->where('name', 'like', '%' . $this->q . '%');
            $query->orWhere('email', 'like', '%' . $this->q . '%');
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
