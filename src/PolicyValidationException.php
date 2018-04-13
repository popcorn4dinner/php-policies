<?php

namespace Popcorn4dinner\Policies;

use Throwable;

class PolicyValidationException extends \Exception
{
    /**
     * PolicyValidationException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
