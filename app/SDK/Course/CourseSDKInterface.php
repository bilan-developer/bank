<?php


namespace App\SDK\Course;


use Illuminate\Support\Collection;

interface CourseSDKInterface
{

    /**
     * Getting an up-to-date course.
     *
     * @param array $filter
     * @return array
     */
    public function getCourse($filter = []);

}
