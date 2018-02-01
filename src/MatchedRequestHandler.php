<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Exceptions\MatchedHandlerTypeException;

class MatchedRequestHandler implements RequestHandlerInterface
{
    /**
     * The value matched by the router.
     *
     * @var mixed
     */
    private $delegate;

    /**
     * The attributes name => value pairs matched by the router.
     *
     * @var array
     */
    private $attributes;

    /**
     * Set up a matched request handler with the given delegate and attributes.
     *
     * @param mixed $delegate
     * @param array $attributes
     */
    public function __construct($delegate, array $attributes)
    {
        $this->delegate = $delegate;
        $this->attributes = $attributes;
    }

    /**
     * Create a new request with the attributes and proxy the matched request
     * handler ->handle() method with this new request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Ellipse\Router\Exceptions\MatchedHandlerTypeException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->delegate instanceof RequestHandlerInterface) {

            $keys = array_keys($this->attributes);

            return $this->delegate->handle(array_reduce($keys, function ($request, $key) {

                return $request->withAttribute($key, $this->attributes[$key]);

            }, $request));

        }

        throw new MatchedHandlerTypeException($this->delegate);
    }
}
