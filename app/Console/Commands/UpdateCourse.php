<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\SDK\Course\CourseSDK;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update course';

    protected $sdk;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->sdk = new CourseSDK();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $courses = $this->sdk->getCourse();

            foreach ($courses as $course){
                Course::updateOrCreate(
                    ['bank_id' => $course->r030],
                    [
                        'bank_id' => $course->r030,
                        'name' => $course->txt,
                        'code' => $course->cc,
                        'rate' => round($course->rate, 4),
                        'exchange_date' => Carbon::parse($course->exchangedate)->format('Y-m-d'),
                    ]
                );
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
