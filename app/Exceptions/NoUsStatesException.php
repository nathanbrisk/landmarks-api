<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class NoUsStatesException extends Exception
{
    /**
     * Report the exception.
     *
     * @param $message
     * @return void
     */
    public function report($message)
    {
        Log::alert($message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        $content = [
            'type' => 'about:blank',
            'title' => 'Internal Server Error',
            'detail' => 'Server error occurred. Webmaster has been notified. Please try again later.'
        ];
        return response($content, 500)
            ->header('Content-Type', 'application/problem+json')
            ->header('Content-Language', 'en');
    }
}
