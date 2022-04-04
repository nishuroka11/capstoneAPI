<?php

namespace App\Http\Controllers\API\Notices;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\APIController;
use App\Modules\Addresses\AddressHelper;
use App\Modules\Addresses\Repositories\AddressRepository;
use App\Modules\Notices\Resources\NoticeResource;
use App\Modules\Notices\Repositories\NoticeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NoticeOwnerAPIController extends APIController
{
    private $noticeRepository, $addressRepository;

    public function __construct(
        NoticeRepository $noticeRepository,
        AddressRepository $addressRepository
    )
    {
        $this->noticeRepository = $noticeRepository;
        $this->addressRepository = $addressRepository;
    }

    public function index()
    {
        $notices = $this->noticeRepository->getQuery();

        $notices = $this->noticeRepository->filterQuery($notices, [
            'fk_owner_id' => getSessionUserId(),
        ]);

        $notices = $notices->get();

        return jsonresSuccess(NoticeResource::collection($notices), true, 'Notices retrieved successfully!');
    }

    public function store(Request $request)
    {

        \DB::beginTransaction();
        try {
            $sessionOwnerId = getSessionUserId();

            $rules = [
                'fk_animal_id' => ['required', Rule::exists('animals', 'animal_id')
                    ->where('fk_owner_id', $sessionOwnerId)],
                'notice_title' => 'required',
                'notice_description' => 'required',
                'requested_date_time' => ['required', 'date_format:Y-m-d h:i:s'],
            ];

            $rules = array_merge($rules, AddressHelper::getValidationRules());

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return jsonresValidation($validator->messages());
            }

            $formData = sanitize($request->all());

            $address = $this->addressRepository->create($formData);

            $newData = [
                'fk_animal_id' => $formData['fk_animal_id'],
                'notice_title' => $formData['notice_title'],
                'notice_description' => $formData['notice_description'],
                'requested_date_time' => $formData['requested_date_time'],
                'fk_owner_id' => $sessionOwnerId,
                'fk_from_address_id' => $address->address_id,

            ];

            $notice = $this->noticeRepository->create($newData);

            \DB::commit();

            return jsonresSuccess(new NoticeResource($notice));
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
