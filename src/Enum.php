<?php

declare(strict_types=1);

namespace App;

use UnexpectedValueException;

abstract class Enum
{
    protected $value;

    protected function __construct(string $enum)
    {
        $enum = strtoupper($enum);
        if (!array_key_exists($enum, static::$values)) {
            throw new UnexpectedValueException();
        }

        $this->value = static::$values[$enum];
    }

    public static function __callStatic($enum, $arguments): self
    {
        return static::getInstance($enum);
    }

    protected static function getInstance($enum): self
    {
        if (!isset(static::$cache[$enum])) {
            static::$cache[$enum] = new static($enum);
        }

        return static::$cache[$enum];
    }

    public function __set($name, $value): void
    {
        throw new ReadOnly();
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @return string|int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param string|int|static $value
     * @return bool
     */
    public function is($value): bool
    {
        if ($value instanceof static) {
            return $this->value === $value->value;
        }

        return $this->value === $value;
    }

    /**
     * @param string|int $value
     * @return static
     */
    public static function make($value): self
    {
        $enum = array_search($value, static::$values, true);
        if ($enum === false) {
            throw new UnexpectedValueException();
        }
        return static::getInstance($enum);
    }
}