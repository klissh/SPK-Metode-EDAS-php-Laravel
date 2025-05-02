<?php

namespace App\View\Components\Edas;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Closure;

class Table extends Component
{
    public $title;
    public $data;
    public $kriterias;

    public function __construct($title, $data, $kriterias)
    {
        $this->title = $title;
        $this->data = $data;
        $this->kriterias = $kriterias;
    }

    public function render(): View|Closure|string
    {
        return view('components.edas.table', [
            'title' => $this->title,
            'data' => $this->data,
            'kriterias' => $this->kriterias
        ]);
    }
}

