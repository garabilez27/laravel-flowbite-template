<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'sbmn.index';

    public function index()
    {
        return $this->render('index');
    }

    public function render(string $page, array $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->root,
            's_submenu' => $this->getSubMenu($this->root, $page, 'sbmn'),
            'records' => $records,
            'search' => $search,
        ];
        return view('pages.subs.'.$page, $data);
    }
}
