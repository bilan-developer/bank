<?php


namespace App\SDK\Course;


use App\Exceptions\CourseException;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CourseSDK implements CourseSDKInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Getting an up-to-date course.
     *
     * @param array $filter
     * @return array
     * @throws CourseException
     */
    public function getCourse($filter = [])
    {
        try {
            $option = ['json' => true];
            $response = $this->client->get(config('bank_nbu.url_exchange'), [
                'query' => array_merge($option, $filter)
            ]);

            $courses = json_decode($response->getBody()->getContents());

            if(!is_array($courses) || !count($courses)) throw new CourseException();

            return collect($courses);

        }catch (\Exception $e){
            throw new CourseException();
        }

    }

}
