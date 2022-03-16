<?php

namespace App\Services\Course;


use App\Http\Core\Constants;
use App\Http\Requests\Course\ConvertRequest;
use App\Http\Requests\Course\HistoryRequest;
use App\SDK\Course\CourseSDK;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CourseService
{
    protected $sdk;

    public function __construct()
    {
        $this->sdk = new CourseSDK();
    }

    /**
     * Currency exchange rate history.
     *
     * @param HistoryRequest $request
     *
     * @return mixed
     */
    public function getHistory(HistoryRequest $request)
    {
        $hash = md5($request->getQueryString());

        return Cache::remember($hash, Constants::CACHE_TIME_DAYS, function () use($request) {
            $dateFrom = Carbon::parse($request->date_from);
            $dateTo = Carbon::parse($request->date_to);

            $result = collect();

            while ($dateFrom <= $dateTo){
                $filter = $this->prepareFilter($dateFrom, $request->currency);

                $course = $this->sdk->getCourse($filter)->first();

                if($result->last()){
                    $difference = round($course->rate - $result->last()->rate, 4);
                    $course->difference = abs($difference);
                    $course->sign = $difference >= 0 ? '+' : '-';
                }else{
                    $course->difference = null;
                    $course->sign = null;
                }

                $result->push($course);

                $dateFrom->modify('1 day');
            }

            return $result;
        });
    }

    /**
     * Convert currency.
     *
     * @param ConvertRequest $request
     *
     * @throws \App\Exceptions\CourseException
     */
    public function convert(ConvertRequest $request)
    {
        $dateFrom = Carbon::parse($request->date);
        $filter = $this->prepareFilter($dateFrom, $request->currency);


        $course = $this->sdk->getCourse($filter)->first();

        return round($course->rate * $request->amount, 2);
    }

    /**
     * Prepare filter for query.
     *
     * @param $date
     * @param $currency
     *
     * @return array
     */
    private function prepareFilter($date, $currency)
    {
        return [
            'date' => $date->format('Ymd'),
            'valcode' => $currency,
        ];
    }

}
