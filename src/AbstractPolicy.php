<?php

namespace StepStone\SeedCommons\Policies;


use Esky\Enum\Enum;

abstract class AbstractPolicy implements PolicyInterface
{
    protected const ERROR_MESSAGE = "Something went wrong";

    /**
     * @var Enum
     */
    private $excludedActions;

    /**
     * AbstractPolicy constructor.
     * @param Enum[] ...$excludedActions
     */
    public function __construct(Enum ...$excludedActions)
    {
        $this->excludedActions = $excludedActions;
    }

    /**
     * @param $subject
     * @return bool
     * @throws PolicyValidationException
     */
    abstract protected function isViolatedWith($subject, Enum $action): bool;

    /**
     * @param $subject
     * @param Enum $action
     * @return bool
     * @throws PolicyValidationException
     */
    public function applyFor($subject, Enum $action): bool
    {
        if ($this->shouldBeApplied($action)) {
            if ($this->isViolatedWith($subject, $action)) {
                throw new PolicyValidationException(static::ERROR_MESSAGE);
            } else {
                return true;
            }
        }

        return true;
    }

    /**
     * @param Enum $action
     * @return bool
     */
    protected function shouldBeApplied(Enum $action){
        return !in_array($action, $this->excludedActions);
    }

}
