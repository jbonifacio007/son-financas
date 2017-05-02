<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SONFin;

/**
 * Description of ServiceContainer
 *
 * @author boni
 */

use Xtreamwayz\Pimple\Container;
class ServiceContainer implements ServiceContainerInterface
{
    private $container;
    /**
     * ServiceContainer constructor.
     * @param $container
     */
    public function __construct()
    {
        $this->container = new Container();
    }
    public function add(string $name, $service)
    {
        $this->container[$name] = $service;
    }
    public function addLazy(string $name, callable $callable)
    {
        $this->container[$name] = $this->container->factory($callable);
    }
    public function get(string $name)
    {
        return $this->container->get($name);
    }
    public function has(string $name)
    {
        return $this->container->has($name);
    }
}
