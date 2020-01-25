<?php

declare(strict_types=1);

namespace App\Transitions;

use App\Cached\Enum;
use \RuntimeException;

abstract class FiniteStateMachineEnum extends Enum
{
    public function canTransitionTo(self $enum): bool
    {
        return in_array($enum->value, static::$transitions[$this->value], true);
    }

    public function transition(self $enum): self
    {
        if (!$enum instanceof static) {
            throw new RuntimeException('Invalid Enum');
        }

        if (!$this->canTransitionTo($enum)) {
            throw new RuntimeException('Invalid Transition');
        }

        return $enum;
    }
}