<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function successMessage(string $message = 'Record has been added successfully.')
    {
        return [
            'content' => $message,
            'status' => 'Success',
        ];
    }

    protected function warningMessage(string $message = 'Something went wrong. Please try again.')
    {
        return [
            'content' => $message,
            'status' => 'Warning',
        ];
    }

    protected function infoMessage(string $message = 'Record has been added successfully.')
    {
        return [
            'content' => $message,
            'status' => 'Info',
        ];
    }

    protected function dangerMessage(string $message = 'Unexpected error occured. Please contact the Developers regarding this matter.')
    {
        return [
            'content' => $message,
            'status' => 'Danger',
        ];
    }

    protected function getSubMenu(string $root, string $page, string $prefix = '')
    {
        $user = session()->get('user');

        // Existing in sidebar
        if(isset($user->menus[$root]['sub'][$prefix.'.'.$page]))
        {
            return $prefix.'.'.$page;
        }

        //
        if($this->inPageAction($page))
        {
            return $prefix.'.index';
        }

        // Menu have no branch
        if(!$user->menus[$root]['branched'])
        {
            return '';
        }

        return $prefix.'.index';
    }

    protected function inPageAction(string $page)
    {
        $actions = [
            'add',
            'edit',
            'view'
        ];

        return in_array($page, $actions);
    }
}
