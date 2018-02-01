<?php declare(strict_types=1);

namespace Ellipse\Router;

interface RouterAdapterFactoryInterface
{
    /**
     * Return a new router adapter.
     *
     * @param \Ellipse\Router\RouterAdapterInterface
     */
    public function __invoke(): RouterAdapterInterface;
}
