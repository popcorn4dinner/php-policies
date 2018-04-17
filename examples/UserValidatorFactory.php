<?php

namespace Popcorn4dinner\Policies\Examples;

use Popcorn4dinner\Policies\Examples\Policies\EmailFormatPolicy;
use Popcorn4dinner\Policies\Examples\Policies\EmailUniquenessPolicy;
use Popcorn4dinner\Policies\Examples\Policies\PasswordLengthPolicy;
use Popcorn4dinner\Policies\Examples\Policies\PasswordCharactersPolicy;
use Popcorn4dinner\Policies\BasicValidator;

class UserValidatorFactory
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @return UserValidator
     */
    public function create(UserRepositoryInterface $userRepository)
    {
        return new BasicValidator(
            new EmailFormatPolicy(),
            new EmailUniquenessPolicy($userRepository),
            new PasswordLengthPolicy(UserAction::REGISTER(), UserAction::ADMIN_UPDATE()),
            new PasswordStrengthPolicy(UserAction::REGISTER(), UserAction::ADMIN_UPDATE())
        );
    }
}
