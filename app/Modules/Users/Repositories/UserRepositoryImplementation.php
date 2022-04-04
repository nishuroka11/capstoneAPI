<?php

namespace App\Modules\Users\Repositories;

use App\Events\User\SendEmailVerificationCodeEvent;
use App\Helpers\ImageHelper;
use App\Models\User;
use App\Modules\Users\Constants\UserConstant;
use App\Repositories\RepositoryImplementation;
use Intervention\Image\Facades\Image;

class UserRepositoryImplementation extends RepositoryImplementation implements UserRepository
{
    /**
     * @return User|mixed
     */
    public function getModel()
    {
        return new User();
    }

    public function getQueryWithoutSuperAdmin()
    {
        return $this->getModel()->where('is_super_administrator', '<>', 1);
    }

    /**
     * @param $query
     * @param $roleId
     * @return mixed
     */
    public function filterByRoleId($query, $roleId)
    {
        return $query->whereHas('roles', function ($roleQuery) use ($roleId) {
            $roleQuery->where('id', $roleId);
        });
    }

    /**
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        if (empty($data['name']) && (!empty($data['first_name']) || !empty($data['last_name']))) {
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        }
        $user = $this->getModel()->create($data);

        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        } else {
            $user->roles()->sync([]);
        }

        return $user;
    }

    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function update(array $data, $id)
    {
        $user = $this->find($id);

        $user->update($data);

        if (!empty($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }
        return $user;
    }

    /**
     * @param $id
     * @param $imageUrl
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveImageUrl($imageUrl, User $user)
    {
        $user->update([
            'profile_photo_path' => $imageUrl
        ]);
        return $user;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function generateEmailVerificationCode(User $user)
    {
        $isUpdated = $user->update([
            'email_verification_code' => generateVerificationCode(),
            'email_verification_expires_at' => now()->addMinutes(UserConstant::EXPIRY_TIME_FOR_EMAIL_VERIFICATION_CODE)
        ]);

        if ($isUpdated) {
            event(new SendEmailVerificationCodeEvent($user));
        }

        return $user;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function verifyEmailVerificationCode(User $user)
    {
        $user->update([
            'email_verified_at' => now()->toDateTimeString()
        ]);
        return $user;
    }

    /**
     * @param $inputs
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateProfile($inputs, User $user)
    {
        $newInputs['name'] = extractFromArray($inputs, 'name');
        if (empty($newInputs['name'])) {
            $newInputs['name'] = extractFromArray($inputs, 'first_name') . ' ' . extractFromArray($inputs, 'last_name');
        }
        $uploadedImageUrl = null;
        $encodedImage = $inputs['encoded_image'];
        if (!empty($encodedImage)) {
            deleteFileByUrl($user->profile_photo_path);
            $fileName = 'users/' . getImageRandomName() . '.jpg';
            $image = Image::make(base64_decode($encodedImage));
            $image = resizeImage($image, ImageHelper::MAX_SIZE_FOR_THUMB);
            $uploadedImageUrl = uploadImageInSystem($image, $fileName);
            $newInputs['profile_photo_path'] = $uploadedImageUrl;
        }

        if(!empty($inputs['years_of_experience'])){
            $newInputs['years_of_experience'] = extractFromArray($inputs, 'years_of_experience');
        }

        if(isset($inputs['is_available'])){
            $newInputs['is_available'] = extractFromArray($inputs, 'is_available');
        }

        $user->update($newInputs);
        return $user;
    }

    public function isProvidedEmailVerified($emailAddress)
    {
        $user = $this->getModel()->where('email', $emailAddress)->first();
        if (empty($user)) {
            return false;
        }
        if ($user->isEmptyVerified()) {
            return false;
        }

        return true;
    }

    public function emptyNonVerifiedEmail($emptyNonVerifiedEmail)
    {
        $this->getModel()->where('email', $emptyNonVerifiedEmail)
            ->update([
                'email' => null
            ]);
    }

    public function changePassword($password, $userId)
    {
        $user = $this->find($userId);
        $user->update([
            'password' => bcrypt($password),
            'password_changed_at' => now()->toDateTimeString(),
        ]);
        return $user;
    }

    public function filterQuery($query, $data)
    {
        $nameLike = extractFromArray($data, 'name_like');
        $emailLike = extractFromArray($data, 'email_like');
        $roleId = extractFromArray($data, 'role_id');

        if(!empty($nameLike)){
            $query = $this->filterLikeBy($query, 'name', $nameLike);
        }

        if(!empty($emailLike)){
            $query = $this->filterLikeBy($query, 'email', $emailLike);
        }

        if(!empty($roleId)){
            $query = $this->filterByRoleId($query, $roleId);
        }

        return $query;
    }
}
