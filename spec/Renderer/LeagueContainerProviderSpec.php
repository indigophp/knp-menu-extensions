<?php

namespace spec\Indigo\KnpMenu\Renderer;

use League\Container\ContainerInterface;
use Knp\Menu\Renderer\RendererInterface;
use PhpSpec\ObjectBehavior;

class LeagueContainerProviderSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container, 'main', ['main' => 'list']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\KnpMenu\Renderer\LeagueContainerProvider');
    }

    function it_is_a_provider()
    {
        $this->shouldImplement('Knp\Menu\Renderer\RendererProviderInterface');
    }

    function it_returns_a_renderer_by_name(ContainerInterface $container, RendererInterface $renderer)
    {
        $container->get('list')->willReturn($renderer);

        $this->get('main')->shouldReturn($renderer);
    }

    function it_returns_the_default_renderer(ContainerInterface $container, RendererInterface $renderer)
    {
        $container->get('list')->willReturn($renderer);

        $this->get()->shouldReturn($renderer);
    }

    function it_throws_an_exception_when_renderer_is_not_found()
    {
        $this->shouldThrow('InvalidArgumentException')->duringGet('another');
    }

    function it_checks_whether_a_renderer_is_available()
    {
        $this->has('main')->shouldReturn(true);
        $this->has('another')->shouldReturn(false);
    }
}
