<?php

namespace App\Modules\Users\Rules;

use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class VerifiedEmailAddressRule implements Rule
{
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userRepository = app(UserRepository::class);
        return $userRepository->isProvidedEmailVerified($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Provided email is not verified';
    }
}
