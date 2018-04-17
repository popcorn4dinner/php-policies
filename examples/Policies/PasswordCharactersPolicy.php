<?php

namespace Popcorn4dinner\Policies\Examples\Policies;

use Popcorn4dinner\Policies\AbstractPolicy;
use Popcorn4dinner\Policies\Examples\User;
use Popcorn4dinner\Policies\Examples\UserAction;
use Popcorn4dinner\Policies\Examples\UserRepositoryInterface;

class PasswordCharactersPolicy extends AbstractPolicy
{
    protected const ERROR_MESSAGE = 'Password not strong enough.';

    private const NUMBER_IN_PASSWORD = '#[0-9]+#';
    private const LOWERCASE_CHARACTERS = '#[a-z]+#';
    private const UPPERCASE_CHARACTERS = '#[A-Z]+#';

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
        $includesNumber = preg_match(static::NUMBER_IN_PASSWORD, $password);
        $includesUpperCaseCharacters = preg_match(static::UPPERCASE_CHARACTERS, $password);
        $includesLowerCaseCharacters = preg_match(static::LOWERCASE_CHARACTERS, $password);

        return !($includesNumber && $includesUpperCaseCharacters && $includesLowerCaseCharacters);
    }
}
