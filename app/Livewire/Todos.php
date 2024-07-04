<?php

namespace App\Livewire;

use Livewire\Component;

class Todos extends Component
{
    public $todos;

    public $todo = "";

    public function add()
    {
        // $this->todos[] = $this->todo;
        // $this->todo = "";
        $this->reset('todo');
    }

    public function updatedTodo($value)
    {
        $this->todos[] = strtoupper($value);
    }

    public function mount()
    {
        $this->todos = ["Makan", "Minum"];
    }

    public function render()
    {
        return view('livewire.todos');
    }
}
