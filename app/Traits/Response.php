<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Build an HTTP_OK response.
     *
     * @param $data
     * @return JsonResponse
     */
    public function httpOK($data)
    {
        return response()->json([
            'success' => true,
            'data'    => $data
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Build an HTTP_CREATED response.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function httpCreated(array $data = [])
    {
        return response()->json([
            'success' => true,
            'data'    => $data
        ], JsonResponse::HTTP_CREATED);
    }

    /**
     * Build an HTTP_NO_CONTENT response.
     *
     * @return JsonResponse
     */
    public function httpNoContent()
    {
        return response()->json([], JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Build an HTTP_BAD_REQUEST response.
     *
     * @param $errors
     * @return JsonResponse
     */
    public function httpBadRequest($errors = [])
    {
        return response()->json([
            'success' => false,
            'errors'  => $errors
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Build a custom response
     *
     * @param $data
     * @param int $statusCode
     * @return JsonResponse|object
     */
    public function httpResponse($data, int $statusCode = JsonResponse::HTTP_OK)
    {
        return response()->json($data)->setStatusCode($statusCode);
    }
}
