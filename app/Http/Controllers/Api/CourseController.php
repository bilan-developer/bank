<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Course\ConvertRequest;
use App\Http\Requests\Course\HistoryRequest;
use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Http\Request;
use App\Http\Resources\Course\Course as CourseResource;
use App\Http\Resources\Course\History as HistoryResource;

class CourseController extends BaseController
{

    /**
     * All exchange rates.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $courses = Course::all();

        return $this->returnData(CourseResource::collection($courses));
    }

    /**
     * Currency exchange rate history.
     *
     * @param HistoryRequest $request
     * @param CourseService $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function history(HistoryRequest $request, CourseService $service)
    {
        $history = $service->getHistory($request);

        return $this->returnData(HistoryResource::collection($history));
    }

    /**
     * Convert currency.
     *
     * @param ConvertRequest $request
     * @param CourseService $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(ConvertRequest $request, CourseService $service)
    {
        $amount = $service->convert($request);

        return $this->returnData(['amount' => $amount]);
    }
}
