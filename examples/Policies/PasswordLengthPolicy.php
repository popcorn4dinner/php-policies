<?php

namespace Popcorn4dinner\Policies\Examples\Policies;

use Popcorn4dinner\Policies\AbstractPolicy;
use Popcorn4dinner\Policies\Examples\User;
use Popcorn4dinner\Policies\Examples\UserAction;
use Popcorn4dinner\Policies\Examples\UserRepositoryInterface;

class PasswordLengthPolicy extends AbstractPolicy
{
    protected const ERROR_MESSAGE = 'Password not long enough.';

    private const MIN_PASSWORD_LENGTH = 8;

    /**
     * @param MvpUser $user
     * @return bool
     * @throws PolicyValidationException
     */
    protected function isViolatedWith(MvpUser $user, UserAction $action): bool
    {
        return $this->isInvalidPassword($user->getPassword());
    }

    private function isInvalidPassword(string $password): bool
    {
        return strlen($password) < static::MIN_PASSWORD_LENGTH;
    }
}
