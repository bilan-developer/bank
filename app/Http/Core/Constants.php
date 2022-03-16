<?php

namespace App\Http\Core;

class Constants
{
    const GENERAL_ERROR_MESSAGE = 'An error occurred during the operation';
    const UNAUTHORIZED_OPERATION_MESSAGE = 'Operation on this resource is prohibited';

    /** HTTP статус коды */
    const OK_STATUS_CODE = 200;
    const CREATED_STATUS_CODE = 201;
    const NO_CONTENT_STATUS_CODE = 204;
    const NOT_AUTHORIZED_STATUS_CODE = 401;
    const NOT_FOUND_STATUS_CODE = 404;
    const NOT_ACCESSIBILITY_STATUS_CODE = 403;
    const UNPROCESSABLE_ENTITY_STATUS_CODE = 422;
    const LOCKED_STATUS_CODE = 423;
    const INTERNAL_SERVER_ERROR = 500;

    const OK_STATUS = 'ok';
    const INFO_STATUS = 'info';
    const WARNING_STATUS = 'warning';
    const ERROR_STATUS = 'error';

    const CACHE_TIME = 10000;
    const CACHE_TIME_LONG = 10000;
    const CACHE_TIME_DAYS = 864000;
    const CACHE_TIME_HOURS = 60;
    const CACHE_TIME_20_MINUTES = 12000;
}
