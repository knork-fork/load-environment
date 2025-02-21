<?php
declare(strict_types=1);

namespace KnorkFork\LoadEnvironment\Tests\Unit;

use KnorkFork\LoadEnvironment\Environment;
use KnorkFork\LoadEnvironment\Tests\Common\UnitTestCase;

/**
 * @internal
 */
final class EnvironmentTest extends UnitTestCase
{
    public function testLoadLoadsFromEnvAndEnvLocal(): void
    {
        Environment::load(__DIR__ . '/../TestData/.env');

        self::assertSame('test string', Environment::getStringEnv('TEST_STRING'));
        self::assertSame('changed', Environment::getStringEnv('CHANGED_IN_LOCAL'));
    }

    public function testLoadLoadsFromCustomFiles(): void
    {
        Environment::load(__DIR__ . '/../TestData/.env', ['custom']);

        self::assertSame('changed', Environment::getStringEnv('CHANGED_IN_CUSTOM'));
    }

    public function testGetStringReturnsUnquotedValuesForQuotedEnv(): void
    {
        Environment::load(__DIR__ . '/../TestData/.env');

        self::assertSame('string with quotes', Environment::getStringEnv('STRING_WITH_QUOTES'));
    }

    public function testGetStringEnvFailsForInvalidEnv(): void
    {
        Environment::load(__DIR__ . '/../TestData/.env');

        $this->expectExceptionMessage('Invalid environment variable INVALID_ENV');
        Environment::getStringEnv('INVALID_ENV');
    }
}
