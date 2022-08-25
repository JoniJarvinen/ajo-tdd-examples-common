<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Common\Domain\Workflow;

interface WorkflowSubjectInterface
{
    public function getAllPlaces(): PlaceCollection;
}