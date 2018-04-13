<?php

namespace Popcorn4dinner\Policies;

use Esky\Enum\Enum;

class PolicyCollection implements PolicyInterface
{

    /**
     * @var PolicyInterface[]
     */
    private $policies;

    public function __construct(PolicyInterface ...$policies)
    {
        $this->policies = $policies;
    }

    public function add(PolicyInterface $policy)
    {
        $this->policies[]= $policy;
        return $this;
    }

    /**
     * @param  $subject
     * @return bool
     * @throws PolicyValidationException
     */

    public function applyFor($subject, Enum $action): bool
    {
        $violations = [];

        foreach ($this->policies as $policy) {
            try {
                $policy->applyFor($subject, $action);
            } catch (PolicyValidationException $exception) {
                $violations[]= $exception->getMessage();
            }
        }

        if (!empty($violations)) {
            throw new PolicyValidationException(join($violations, ', '));
        }

        return true;
    }
}
