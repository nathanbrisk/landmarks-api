<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class NoHighSchoolsFoundException extends Exception
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
            'title' => 'Bad Request',
            'detail' => 'No results found.'
        ];
        return response($content, 404)
            ->header('Content-Type', 'application/problem+json')
            ->header('Content-Language', 'en');
    }
}
