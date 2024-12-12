<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class MenuController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'mn.index';

    public function index()
    {
        $menus = Menus::where('mn_deleted', 0)->get();
        return $this->render('index', $menus);
    }

    public function add()
    {
        return $this->render('add');
    }

    public function render(string $page, mixed $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->root,
            's_submenu' => $this->getSubMenu($this->root, $page, 'mn'),
            'records' => $records,
            'search' => $search,
        ];
        return view('pages.menus.'.$page, $data);
    }
}
