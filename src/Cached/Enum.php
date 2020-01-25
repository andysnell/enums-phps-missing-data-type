<?php

declare(strict_types=1);

namespace App\Cached;

use UnexpectedValueException;

abstract class Enum
{
    protected $value; // The underlying scalar value

    final private function __construct(string $enum)
    {
        $enum = strtoupper($enum);
        if (!array_key_exists($enum, static::$values)) {
            throw new UnexpectedValueException();
        }
        $this->value = static::$values[$enum];
    }

    public static function __callStatic($enum, $args): self
    {
        return static::$cache[$enum] ??= new static($enum);
    }

    public function __set($name, $value): void
    {
        throw new \LogicException("Read Only");
    }

    // Make an instance from an underlying scalar value
    public static function make($value): self
    {
        $enum = array_search($value, static::$values, true);
        if ($enum === false) {
            throw new UnexpectedValueException();
        }
        return static::$cache[$enum] ??= new static($enum);
    }

    // Return the underlying scalar value
    public function value()
    {
        return $this->value;
    }

    // Allow an instance to be cast to a string of the value
    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function is($value): bool
    {
        if ($value instanceof static) {
            return $this->value === $value->value;
        }

        return $this->value === $value;
    }
}