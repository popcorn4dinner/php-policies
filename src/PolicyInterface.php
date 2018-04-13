<?php

namespace Popcorn4dinner\Policies;

use Esky\Enum\Enum;

interface PolicyInterface
{
    /**
     * @param $subject
     * @param Enum $action
     * @return bool
     */
    public function applyFor($subject, Enum $action): bool;
}
