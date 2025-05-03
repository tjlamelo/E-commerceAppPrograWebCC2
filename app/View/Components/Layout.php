<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(public string $title = '', public string $style='', public string $script='')
    {
       $this->title = config('app.name') . ($title ? '-' . $title : '');
       //$this->style = $style ? $style : '';
    }
 
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout', [
            'style'=> $this->style,
            'script'=> $this->script,
            'title'=> $this->title,
    
    ]);
    }
}
