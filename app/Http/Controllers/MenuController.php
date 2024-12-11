<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'mn.index';

    public function index()
    {
        return $this->render('index');
    }

    public function add()
    {
        return $this->render('add');
    }

    public function render(string $page, array $records = [], string $search = '')
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
