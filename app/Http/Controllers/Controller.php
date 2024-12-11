<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successMessage(string $message = 'Record has been added successfully.')
    {
        return [
            'content' => $message,
            'status' => 'Success',
        ];
    }

    public function warningMessage(string $message = 'Something went wrong. Please try again.')
    {
        return [
            'content' => $message,
            'status' => 'Warning',
        ];
    }

    public function infoMessage(string $message = 'Record has been added successfully.')
    {
        return [
            'content' => $message,
            'status' => 'Info',
        ];
    }

    public function dangerMessage(string $message = 'Unexpected error occured. Please contact the Developers regarding this matter.')
    {
        return [
            'content' => $message,
            'status' => 'Danger',
        ];
    }
}
