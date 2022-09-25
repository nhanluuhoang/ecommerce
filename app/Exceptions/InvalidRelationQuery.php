<?php

namespace App\Exceptions;

use Exception;

class InvalidRelationQuery extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $this->message
        ], 404);
    }
}
