<?php

declare(strict_types=1);

namespace App\NoDependencies;

use UnexpectedValueException;

final class ExecutionEnvironment
{
    protected string $environment;

    protected static array $environments = ['http', 'cli', 'worker'];

    private function __construct(string $environment)
    {
        if (!in_array($environment, static::$environments, true)) {
            throw new UnexpectedValueException('invalid environment');
        }
        $this->environment = $environment;
    }

    public static function HTTP(): ExecutionEnvironment
    {
        return new self('http');
    }

    public static function CLI(): ExecutionEnvironment
    {
        return new self('cli');
    }

    public static function WORKER(): ExecutionEnvironment
    {
        return new self('worker');
    }
}
