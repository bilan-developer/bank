<?php

namespace App\Http\Controllers\Api;

use App\Http\Core\Constants;
use App\Models\Course;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Autocomplete\Currency as CurrencyResource;

class AutocompleteController extends BaseController
{

    /**
     * Selection of available currencies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function currency()
    {
        $currencies = Cache::remember('autocomple_currencies', Constants::CACHE_TIME_DAYS, function () {
            return  Course::select('code', 'name')->get();
        });

        return $this->returnData(CurrencyResource::collection($currencies));
    }
}
;
