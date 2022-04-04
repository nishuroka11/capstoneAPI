<?php

namespace App\Helpers;

class ResponseHelper
{
    const STATUS_CODE_FOR_SUCCESS = 200;
    const STATUS_CODE_FOR_UNAUTHORIZED = 401;
    const STATUS_CODE_FOR_PAYMENT_REQUIRED_NOT_PAID = 402;
    const STATUS_CODE_FOR_NOT_FOUND = 404;
    const STATUS_CODE_FOR_VALIDATION_ERROR = 422;
    const STATUS_CODE_FOR_ACCESS_LOCKED = 423;
    const STATUS_CODE_FOR_INTERNAL_SERVER_ERROR = 500;
    const STATUS_CODE_FOR_EMAIL_NOT_FOUND = 701;
    const STATUS_CODE_FOR_EMAIL_NOT_VERIFIED = 702;

    const STATUS_MESSAGE_FOR_SUCCESS = 'Success!';
    const STATUS_MESSAGE_FOR_UNAUTHORIZED = 'Unauthorized';
    const STATUS_MESSAGE_FOR_PAYMENT_REQUIRED_NOT_PAID = 'Payment is required';
    const STATUS_MESSAGE_FOR_NOT_FOUND = 'Not Found';
    const STATUS_MESSAGE_FOR_VALIDATION_ERROR = 'Invalid data provided';
    const STATUS_MESSAGE_FOR_ACCESS_LOCKED = 'Access Denied';
    const STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR = 'Something went wrong! Please try again';
    const STATUS_MESSAGE_FOR_EMAIL_NOT_FOUND = 'Email not found';
    const STATUS_MESSAGE_FOR_EMAIL_NOT_VERIFIED = 'Email has been sent. Please check your mail';
}
