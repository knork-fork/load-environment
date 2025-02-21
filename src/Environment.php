<?php
declare(strict_types=1);

namespace KnorkFork\LoadEnvironment;

use Exception;

final class Environment
{
    /**
     * @param string[] $fileVariants
     */
    public static function load(string $envFile, array $fileVariants = ['local']): void
    {
        if (!is_file($envFile)) {
            throw new Exception('Environment file not found: ' . $envFile);
        }

        self::loadEnvFile($envFile);

        foreach ($fileVariants as $fileVariant) {
            $variant = $envFile . '.' . $fileVariant;
            if (is_file($variant)) {
                self::loadEnvFile($variant);
            }
        }
    }

    public static function getStringEnv(string $var): string
    {
        $value = getenv($var);
        if (!\is_string($value)) {
            throw new Exception("Invalid environment variable {$var}");
        }

        return $value;
    }

    private static function loadEnvFile(string $envFile): void
    {
        $lines = file($envFile, \FILE_IGNORE_NEW_LINES | \FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            // Handle values with quotes
            if (preg_match('/\A([\'"])(.*)\1\z/', $value, $matches)) {
                $value = $matches[2];
            }

            putenv("{$name}={$value}");
        }
    }
}
