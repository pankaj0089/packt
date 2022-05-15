<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Author;

class AuthorsDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $authors = Author::pluck('name', 'id')->sortBy('name');
      return view('components.authors-dropdown', compact('authors'));
    }
}
