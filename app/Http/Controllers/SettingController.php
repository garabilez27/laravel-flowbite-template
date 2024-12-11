<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'settings';

    public function index()
    {
        return $this->render('display');
    }

    public function render(string $page, array $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->root,
            's_submenu' => '',
            'records' => $records,
            'search' => $search,
        ];
        return view('pages.'.$page, $data);
    }
}
