<?php

namespace Api\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        // If method is post, check if the _method value is in the body
        // If the method is patch, put, or delete make the request that type
        if ($request->getMethod() === 'POST') {
            $body = $request->getParsedBody();

            if (isset($body['_method'])) {
                $method = strtoupper($body['_method']);

                if (in_array($method, ['PATCH', 'PUT', 'DELETE'])) {
                    $request = $request->withMethod($method);
                    unset($body['_method']);
                    $request = $request->withParsedBody($body);
                }
            }
        }

        return $handler->handle($request);
    }
}