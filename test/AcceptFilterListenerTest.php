<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\ContentNegotiation;

use Laminas\ApiTools\ContentNegotiation\AcceptFilterListener;
use Laminas\Http\Headers;
use Override;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use ReflectionMethod;

class AcceptFilterListenerTest extends TestCase
{
    use ProphecyTrait;

    /** @var AcceptFilterListener */
    protected $listener;

    #[Override]
    protected function setUp(): void
    {
        $this->listener = new AcceptFilterListener();
    }

    #[Group('58')]
    public function testMissingAcceptHeaderIndicatesValidMediaType(): void
    {
        $headers = $this->prophesize(Headers::class);
        $headers->has('accept')->willReturn(false);

        $r = new ReflectionMethod($this->listener, 'validateMediaType');

        $this->assertTrue($r->invoke($this->listener, 'application/json', $headers->reveal()));
    }
}
