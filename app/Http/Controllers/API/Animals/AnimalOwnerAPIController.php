<?php

namespace App\Http\Controllers\API\Animals;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\APIController;
use App\Modules\Animals\AnimalHelper;
use App\Modules\Animals\Repositories\AnimalRepository;
use App\Modules\Animals\Resources\AnimalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AnimalOwnerAPIController extends APIController
{
    private $animalRepository;

    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    public function index(Request $request)
    {
        try {
            $filterData = [
                'fk_owner_id' => getSessionUserId(),
            ];

            $query = $this->animalRepository->getQuery();

            $animals = $this->animalRepository->filterQuery($query, $filterData);

            $animals = $animals->get();

            return jsonresSuccess(AnimalResource::collection($animals), true, 'Animals retrieved successfully!');

        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('AnimalOwnerAPIController index' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $rules = [
                'animal_name' => 'required',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'encoded_image_url' => 'nullable',
                'breed_type' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return jsonresValidation($validator->messages());
            }

            $user = getSessionUser();

            if (!AnimalHelper::canUserCreateNewAnimal($user)) {
                $errorMessage = 'User already have animal(s)';
                return jsonres(['errors' => ['animal_count' => [$errorMessage]]], 422, $errorMessage);
            }

            $formData = sanitize($request->all());

            $formData['fk_owner_id'] = getSessionUserId();

            $animal = $this->animalRepository->create($formData);

            \DB::commit();

            return jsonresSuccess(new AnimalResource($animal));
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('AnimalOwnerApiController@store' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function update(Request $request, $animalId)
    {
        $animal = $this->animalRepository->find($animalId);

        if(empty($animal)){
            return jsonresNotFound();
        }

        \DB::beginTransaction();

        try {
            $rules = [
                'animal_name' => 'required',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'encoded_image_url' => 'nullable',
                'breed_type' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return jsonresValidation($validator->messages());
            }

            $userId = getSessionUserId();

            if($animal->fk_owner_id != $userId){
                $errorMessage = 'The animal is not associated with the logged in owner.';
                return jsonres(['errors' => ['animal_count' => [$errorMessage]]], 422, $errorMessage);
            }

            $formData = sanitize($request->only(['animal_name', 'date_of_birth', 'breed_type']));

            $animal = $this->animalRepository->update($formData, $animalId);

            \DB::commit();

            return jsonresSuccess(new AnimalResource($animal));
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('AnimalOwnerApiController@store' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function delete($animalId)
    {
        $animal = $this->animalRepository->find($animalId);

        if(empty($animal)){
            return jsonresNotFound();
        }

        \DB::beginTransaction();

        try {
            $userId = getSessionUserId();

            if($animal->fk_owner_id != $userId){
                $errorMessage = 'The animal is not associated with the logged in owner.';
                return jsonres(['errors' => ['animal_count' => [$errorMessage]]], 422, $errorMessage);
            }

            $this->animalRepository->delete($animalId);

            \DB::commit();

            return jsonresSuccess([], 200, 'Deleted Successfully!');
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('AnimalOwnerApiController@store' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
