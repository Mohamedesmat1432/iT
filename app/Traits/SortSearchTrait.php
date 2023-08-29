<?php

namespace App\Traits;

trait SortSearchTrait
{
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }
}