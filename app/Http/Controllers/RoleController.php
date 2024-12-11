<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'rl.index';

    public function index()
    {
        return $this->render('index');
    }

    public function render(string $page, array $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->root,
            's_submenu' => $this->getSubMenu($this->root, $page, 'rl'),
            'records' => $records,
            'search' => $search,
        ];
        return view('pages.roles.'.$page, $data);
    }
}
