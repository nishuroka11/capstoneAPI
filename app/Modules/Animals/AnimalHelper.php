<?php

namespace App\Modules\Animals;

class AnimalHelper
{
    public static function configOwnerCanHaveAnimals()
    {
        return config('features.animal.an_owner_can_have_animals');
    }

    /**
     * @return bool
     */
    public static function canOwnerHaveUnlimitedAnimals()
    {
        return static::configOwnerCanHaveAnimals() == 0;
    }

    public static function canUserCreateNewAnimal($user)
    {
        if (!$user->isUserTypeOwner()) {
            return false;
        }

        if (self::canOwnerHaveUnlimitedAnimals()) {
            return true;
        }

        if($user->animals->count() < static::configOwnerCanHaveAnimals()){
            return true;
        }

        return false;
    }
}
