<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class InvalidSlugException extends Exception
{
    /**
     * Report the exception.
     *
     * @param $message
     * @return void
     */
    public function report($message)
    {
        Log::notice($message);
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
            'title' => 'Bad Request',
            'detail' => 'Invalid slug supplied.'
        ];
        return response($content, 400)
            ->header('Content-Type', 'application/problem+json')
            ->header('Content-Language', 'en');
    }
}
