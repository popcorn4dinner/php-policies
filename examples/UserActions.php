<?php

namespace Popcorn4dinner\Policies\Examples;

use Esky\Enum\Enum;

class UserAction extends Enum
{
    const CREATE    = 1;
    const REGISTER  = 2;
    const UPDATE    = 3;
    const DELETE    = 4;
    const ADMIN_UPDATE = 5;
}
