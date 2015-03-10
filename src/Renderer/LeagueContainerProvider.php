<?php

/*
 * This file is part of the Indigo KnpMenu package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\KnpMenu\Renderer;

use Knp\Menu\Renderer\RendererProviderInterface;
use League\Container\ContainerInterface;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class LeagueContainerProvider implements RendererProviderInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $defaultRenderer;

    /**
     * @var array
     */
    protected $rendererIds;

    /**
     * @param ContainerInterface $container
     * @param string             $defaultRenderer
     * @param array              $rendererIds
     */
    public function __construct(ContainerInterface $container, $defaultRenderer, array $rendererIds)
    {
        $this->container = $container;
        $this->defaultRenderer = $defaultRenderer;
        $this->rendererIds = $rendererIds;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name = null)
    {
        if (is_null($name)) {
            $name = $this->defaultRenderer;
        }

        if (!isset($this->rendererIds[$name])) {
            throw new \InvalidArgumentException(sprintf('The renderer "%s" is not defined', $name));
        }

        return $this->container->get($this->rendererIds[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->rendererIds[$name]);
    }
}
