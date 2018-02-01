<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;

interface RouterAdapterInterface
{
    /**
     * Return a matched request handler for the given request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Ellipse\Router\MatchedRequestHandler
     * @throws \Ellipse\Router\Exceptions\NotFoundException
     * @throws \Ellipse\Router\Exceptions\MethodNotAllowedException
     */
    public function match(ServerRequestInterface $request): MatchedRequestHandler;
}
