<?php

namespace App\Http\Livewire\Author;

use Livewire\Component;
use App\Models\Author;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Listing extends Component
{
  use WithPagination;
  use LivewireAlert;
  public $action = 'author';
  public $heading = 'Author';
  public $q;
  public $sortBy = 'name';
  public $sortAsc = true;
  public $item;
  public $deleteID = '';

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

  public function deleteRecord($id) {
      $this->deleteID = $id;
  }

  public function delete() {
    if( Author::find($this->deleteID)->delete() ) {
      $this->flash('success', 'User has been deleted successfully!');
      return redirect()->route($this->action.'.listing');
    }
  }
}
