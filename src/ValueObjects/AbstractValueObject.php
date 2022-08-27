<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\ValueObjects;

use Ajo\Tdd\Examples\Common\Equatable;
use ReflectionClass;
use ReflectionProperty;

/**
 * Base implementation of value object which implements Equatable interface
 */
abstract class AbstractValueObject implements Equatable
{
    /**
     * Recursive implementation for nested Value Objects. 
     * 
     * If all encapsulated class properties are equal returns TRUE. Otherwise FALSE. 
     * Encapsulated values are all excluding public non-readonly values of the class. 
     * 
     * This implementation accesses private properties with reflection 
     * and checks the corresponding class and disregards nulls. 
     * 
     * If any value implements the Equatable interface then it is used to compare. 
     * Otherwise PHP strict comparsion === is used to compare the two values
     *
     * @param mixed $that
     * @return boolean
     */
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