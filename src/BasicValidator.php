<?php

namespace Popcorn4dinner\Policies;

use Esky\Enum;

class BasicValidator
{
    /**
     * @var PolicyInterface
     */
    private $policies;

    /**
     * BasicValidator constructor.
     * @param PolicyInterface[] ...$policies
     */
    public function __construct(PolicyInterface ...$policies)
    {
        $this->policies = new PolicyCollection();

        foreach ($policies as $policy) {
            $this->policies->add($policy);
        }
    }

  
    public function isValid($subject, Enum $action)
    {
        return $this->policies->applyFor($subject, $action);
    }
}
