<?php

namespace App\Http\Middleware;

//namespace Tymon\JWTAuth\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class GetUserFromJWT extends BaseMiddleware
{

    protected function respond($event, $error, $status, $payload = [])
    {
        $response = $this->events->fire($event, $payload, true);

        return $response ?: $this->response->json([
            'code' => $status,
            'message' => $error
        ], $status);
    }

    public function handle($request, Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return $this->respond('tymon.jwt.absent', 'Token not provided', 400);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return $this->respond('tymon.jwt.expired', 'Expired token', $e->getStatusCode(), [$e]);
        } catch (JWTException $e) {
            return $this->respond('tymon.jwt.invalid', 'Invalid token', $e->getStatusCode(), [$e]);
        }

        if (! $user) {
            return $this->respond('tymon.jwt.user_not_found', 'User not found', 404);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
