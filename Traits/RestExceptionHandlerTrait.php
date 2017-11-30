<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 7/10/17
 * Time: 4:19 PM
 */

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

trait RestExceptionHandlerTrait
{

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch(true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound([
                    'trace' => $e->getTrace()
                ], $e->getMessage());
                break;
            case $this->isRouteNotFound($e):
                $retval = $this->routeNotFound();
                break;
            default:
                $retval = $this->badRequest([
                    'exception' => $e,
                    'request' => $request,
                    'body' => $request->all(),
                    'trace' => $e->getTrace()
                ], $e->getMessage());
        }
//        return response()->json($e->getLine());

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param $request
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($request, $message='Bad request', $statusCode=400)
    {
        return $this->jsonResponse([
            'code' => $statusCode,
            'message' => $message,
            'debug' => $request
        ], $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @param array $debug
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($debug = [], $message='Model not found', $statusCode=404)
    {
        return $this->jsonResponse([
            'code' => $statusCode,
            'message' => $message,
            'debug' => $debug
        ], $statusCode);
    }

    /**
     * Returns json response for route not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function routeNotFound($message='Route not found', $statusCode=404)
    {
        return $this->jsonResponse([
            'code' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload=null, $statusCode=404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isRouteNotFound(Exception $e)
    {
        return $e instanceof RouteNotFoundException;
    }

//    protected function isTokenNotProvided(Exception $e)
//    {
//        return $e instanceof
//    }

}