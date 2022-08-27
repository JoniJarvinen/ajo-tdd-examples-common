<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\ValueObjects;

use Ajo\Tdd\Examples\Common\Equatable;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractValueObject implements Equatable
{
    public function equals(mixed $that): bool
    {
        if (
            $that === null ||
            !$that instanceof static
        ) {
            return false;
        }

        $thisReflection = new ReflectionClass(static::class);
        $thatReflection = new ReflectionClass($that);

        $thisEncapsulatedProperties = $thisReflection->getProperties(
            ReflectionProperty::IS_PRIVATE |
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_READONLY
        );

        $hasUnequalPropery = false;

        foreach($thisEncapsulatedProperties as $thisProperty)
        {
            $thisPropertyValue = $thisProperty->getValue($this);
            $thatPropertyValue = $thatReflection->getProperty($thisProperty->getName())->getValue($that);
            if($thisPropertyValue instanceof Equatable)
            {
                $hasUnequalPropery = !$thisPropertyValue->equals($thatPropertyValue);
            } else {
                $hasUnequalPropery = $thisPropertyValue !== $thatPropertyValue;
            }
            if($hasUnequalPropery === true)
            {
                break;
            }
        }

        return !$hasUnequalPropery;
    }
}