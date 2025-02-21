<?php
declare(strict_types=1);

namespace KnorkFork\LoadEnvironment\Tests\Common;

use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
