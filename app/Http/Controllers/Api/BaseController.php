<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Core\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{

    /**
     * @param $method
     * @param $parameters
     * @return \Illuminate\Http\JsonResponse
     */
    public function callAction($method, $parameters)
    {
        try {
            return parent::callAction($method, $parameters);
        } catch (\Exception $e) {
            return $this->getErrorResponse($e);
        }
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unauthorized($message)
    {
        return Response::json([
            'status' => 'error',
            'message' => $message,
        ], 401);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser()
    {
        return Auth::user();
    }

    /**
     * Return of successful status
     *
     * @param integer $statusCode
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getOkResponse($statusCode = Constants::OK_STATUS_CODE, $headers = [])
    {
        $response  = response()->json([
            'status' => Constants::OK_STATUS,
        ], $statusCode);
        if ($headers) {
            $response->withHeaders($headers);
        }

        return $response;
    }


    /**
     * Return of data.
     * Repeats the Resource structure.
     *
     * data:{object:{}}
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnData($data = [])
    {
        $response  = response()->json([
            'data' => $data,
        ]);

        $response->withHeaders(['Cache-Control' => 'no-cache, no-store, must-revalidate']);

        return $response;
    }

    /**
     * Returning errors
     *
     * @param \Exception $exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getErrorResponse(\Exception $exception)
    {
        if ($exception instanceof \App\Exceptions\ExceptionInterface){
            return response()->json([
                'status' => Constants::ERROR_STATUS,
                'message' => $exception->getMessage(),
            ], $exception->getStatusCode());
        }

        return response()->json([
            'status' => Constants::ERROR_STATUS,
            'message' => Constants::GENERAL_ERROR_MESSAGE,
            'message_for_developer' => ((env('APP_DEBUG')==true)?$exception->getMessage():''),
        ], Constants::INTERNAL_SERVER_ERROR);
    }
}
