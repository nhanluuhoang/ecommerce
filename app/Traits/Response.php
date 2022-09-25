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
    public function httpOK($data): JsonResponse
    {
        $arrData = is_array($data) ? $data : $data->toArray();

        $resp = [
            'success' => true,
        ];

        if (count($arrData) > 0) {
            if (isset($arrData['data'])) {
                $resp['data'] = $arrData['data'];
            } else {
                $resp['data'] = $arrData;
            }
        } else {
            $resp['data'] = $arrData['data'];
        }

        if (isset($arrData['current_page'])) {
            $resp['pagination'] = $this->getPagination($data);
        }

        return response()->json($resp, JsonResponse::HTTP_OK);
    }

    /**
     * Build an HTTP_CREATED response.
     *
     * @param $data
     * @return JsonResponse
     */
    public function httpCreated($data)
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

    /**
     * @param $data
     * @return array
     */
    private function getPagination($data): array
    {
        return [
            'count'       => (int) $data->count(),
            'currentPage' => (int) $data->currentPage(),
            'links'       => (string) $data->nextPageUrl(),
            'perPage'     => (int) $data->perPage(),
            'total'       => (int) $data->total(),
            'totalPages'  => (int) $data->lastPage()
        ];
    }
}
