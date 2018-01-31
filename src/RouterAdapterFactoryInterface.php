<?php declare(strict_types=1);

namespace Ellipse\Router;

interface RouterAdapterFactoryInterface
{
    public function __invoke(): RouterAdapterInterface;
}
