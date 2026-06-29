<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_it_can_run(): void
    {
        $this->assertSame(1 + 1, 2);
    }
}
