<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;

class SidebarComposer
{
    protected $menus;
    public function __construct()
    {
        $this->menus = Category::orderBy('id')->get();
    }
    public function compose(View $view)
    {
        $view->with('menus', $this->menus);
    }
}