<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\ValueObjects;

use Ajo\Tdd\Examples\Common\Equatable;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractValueObject implements Equatable
{
    public function equals($value): bool
    {
        if (
            $value === null ||
            !$value instanceof static
        ) {
            return false;
        }

        $valueObjectReflection = new ReflectionClass($this);
        $encapsulatedProperties = $valueObjectReflection->getProperties(
            ReflectionProperty::IS_PRIVATE |
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_READONLY
        );
        $hasUnequalPropery = false;

        foreach($encapsulatedProperties as $property)
        {
            $propertyName = $property->getName();
            if($this->{$propertyName} instanceof Equatable)
            {
                $hasUnequalPropery = !$this->{$propertyName}->equals($value?->{$propertyName});
            } else {
                $hasUnequalPropery = $this->{$propertyName} !== $value?->{$propertyName};
            }
            if($hasUnequalPropery === true)
            {
                break;
            }
        }

        return !$hasUnequalPropery;
    }
}