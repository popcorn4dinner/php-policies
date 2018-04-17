<?php

namespace Popcorn4dinner\Policies\Examples\Policies;

use Popcorn4dinner\Policies\AbstractPolicy;
use Popcorn4dinner\Policies\Examples\User;
use Popcorn4dinner\Policies\Examples\UserAction;
use Popcorn4dinner\Policies\Examples\UserRepositoryInterface;

class EmailUniquenessPolicy extends AbstractPolicy
{
    protected const ERROR_MESSAGE = 'User with email already exists.';

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * EmailPresencePolicy constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, UserAction ...$excludedActions)
    {
        parent::__construct(...$excludedActions);
        $this->userRepository = $userRepository;
    }

    /**
     * @param MvpUser $user
     * @return bool
     * @throws PolicyValidationException
     */
    protected function isViolatedWith(MvpUser $user, UserAction $action): bool
    {
        return !$this->isUniqueEmail($user->getEmail());
    }

    private function isUniqueEmail(string $email): bool
    {
        return $this->userRepository->findByEmail($email) === null;
    }
}
