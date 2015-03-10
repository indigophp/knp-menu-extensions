<?php

namespace spec\Indigo\KnpMenu\Provider;

use League\Container\ContainerInterface;
use Knp\Menu\ItemInterface;
use PhpSpec\ObjectBehavior;

class LeagueContainerProviderSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container, ['main' => 'menu.main']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\KnpMenu\Provider\LeagueContainerProvider');
    }

    function it_is_a_provider()
    {
        $this->shouldImplement('Knp\Menu\Provider\MenuProviderInterface');
    }

    function it_returns_a_menu_instance(ContainerInterface $container, ItemInterface $menu)
    {
        $container->get('menu.main', [])->willReturn($menu);

        $this->get('main')->shouldReturn($menu);
    }

    function it_throws_an_exception_when_the_menu_is_not_found()
    {
        $this->shouldThrow('InvalidArgumentException')->duringGet('sidebar');
    }

    function it_checks_whether_a_menu_is_available()
    {
        $this->has('main')->shouldReturn(true);
        $this->has('sidebar')->shouldReturn(false);
    }
}
