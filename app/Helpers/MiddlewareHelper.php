<?php

namespace App\Helpers;

class MiddlewareHelper
{
    const NAME_FOR_LOGGED_IN_USER = 'jwt.logged-in';
    const NAME_FOR_OPTIONAL_LOGGED_IN_USER = 'jwt.optional-login.verify';
    const NAME_FOR_NORMAL_USER_ROLE = 'jwt.logged-in.normal-user';
    const NAME_FOR_VERIFIED_USER = 'jwt.verified.token';
    const NAME_FOR_NON_VERIFIED_USER = 'jwt.non-verified.token';
    const NAME_FOR_AUTHENTICATED_ROLE = 'auth-role';

    const NAME_FOR_IS_VALID_TOKEN = 'is-valid-token';

    const NAME_FOR_IS_USER_TYPE_OWNER = 'is-user-type-owner';

    const GROUP_FOR_NON_VERIFIED_AUTHENTICATED = [];
}
