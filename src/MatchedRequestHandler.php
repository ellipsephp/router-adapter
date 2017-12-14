<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Exceptions\HandlerIsNotARequestHandlerException;

class MatchedRequestHandler implements RequestHandlerInterface
{
    /**
     * The delegate.
     *
     * @var mixed
     */
    private $delegate;

    /**
     * Set up a matched request handler with the given delegate.
     *
     * @param mixed $delegate
     */
    public function __construct($delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * Proxy the delegate ->handle() method when it is an implementation of
     * request handler interface or fail otherwise.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Ellipse\Router\Exceptions\HandlerIsNotARequestHandlerException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->delegate instanceof RequestHandlerInterface) {

            return $this->delegate->handle($request);

        }

        throw new HandlerIsNotARequestHandlerException($this->delegate);
    }
}
