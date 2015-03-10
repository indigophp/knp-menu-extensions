<?php

/*
 * This file is part of the Indigo KnpMenu package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\KnpMenu\Provider;

use Knp\Menu\Provider\MenuProviderInterface;
use League\Container\ContainerInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class LeagueContainerProvider implements MenuProviderInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $menuIds;

    /**
     * @param ContainerInterface $container
     * @param array              $menuIds
     */
    public function __construct(ContainerInterface $container, array $menuIds = [])
    {
        $this->container = $container;
        $this->menuIds = $menuIds;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name, array $options = [])
    {
        if (!isset($this->menuIds[$name])) {
            throw new \InvalidArgumentException(sprintf('The menu "%s" is not defined', $name));
        }

        return $this->container->get($this->menuIds[$name], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function has($name, array $options = [])
    {
        return isset($this->menuIds[$name]);
    }
}
