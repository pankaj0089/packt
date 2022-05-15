<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Country;

class CountriesDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tabindex;
    public function __construct($tabindex)
    {
        $this->tabindex = $tabindex;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id');
      return view('components.countries-dropdown', compact('countries'));
    }
}
