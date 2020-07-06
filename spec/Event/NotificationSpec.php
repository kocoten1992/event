<?php

namespace spec\Supervisor\Event;

use PhpSpec\ObjectBehavior;
use Supervisor\Event\Notification;

class NotificationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            [
                'ver'        => '3.0',
                'server'     => 'supervisor',
                'serial'     => '21',
                'pool'       => 'listener',
                'poolserial' => '10',
                'eventname'  => 'PROCESS_COMMUNICATION_STDOUT',
                'len'        => '54',
            ],
            [
                'processname' => 'foo',
                'groupname'   => 'bar',
                'pid'         => '123',
            ],
            'This is the data that was sent between the tags'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Notification::class);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('PROCESS_COMMUNICATION_STDOUT');
    }

    function it_returns_a_header()
    {
        $this->getHeader('ver')->shouldReturn('3.0');
        $this->getHeader('non_existent')->shouldReturn(null);
    }

    function it_returns_all_headers()
    {
        $this->getHeader()->shouldReturn([
            'ver'        => '3.0',
            'server'     => 'supervisor',
            'serial'     => '21',
            'pool'       => 'listener',
            'poolserial' => '10',
            'eventname'  => 'PROCESS_COMMUNICATION_STDOUT',
            'len'        => '54',
        ]);
    }

    function it_returns_one_payload_item()
    {
        $this->getPayload('pid')->shouldReturn('123');
    }

    function it_returns_the_whole_payload()
    {
        $this->getPayload()->shouldReturn([
            'processname' => 'foo',
            'groupname'   => 'bar',
            'pid'         => '123',
        ]);
    }

    function it_returns_the_body()
    {
        $this->getBody()->shouldReturn('This is the data that was sent between the tags');
    }
}
