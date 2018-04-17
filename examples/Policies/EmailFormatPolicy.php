<?php

namespace Popcorn4dinner\Policies\Examples\Policies;

use Popcorn4dinner\Policies\AbstractPolicy;
use Popcorn4dinner\Policies\Examples\User;
use Popcorn4dinner\Policies\Examples\UserAction;
use Popcorn4dinner\Policies\Examples\UserRepositoryInterface;

class EmailFormatPolicy extends AbstractPolicy
{
    protected const ERROR_MESSAGE = 'Invalid email address';

    /**
     * @param MvpUser $user
     * @return bool
     * @throws PolicyValidationException
     */
    protected function isViolatedWith(MvpUser $user, UserAction $action): bool
    {
        return $this->isInvalidEmail($user->getEmail());
    }

    /**
     * @param string $email
     * @return bool
     *
     */
    private function isInvalidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) === false;
    }
}
