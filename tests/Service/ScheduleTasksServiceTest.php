<?php

namespace App\Tests;

use App\Factory\JobFactory;
use PHPUnit\Framework\TestCase;
use App\Service\ScheduleTasksService;
use App\Domain\Job;

class ScheduleTasksServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldExecuteAllJobs(): void
    {
        $jobs = [];
        $factory = new JobFactory();
        $params = ["*","*","*","*","*","ls"];
        $job = $factory->createJob($params);
        /**
         * @var array <Job> $jobs
         */
        $jobs[] = $job;

        $schedulerTaskService = new ScheduleTasksService();
        $jobsExecuted = $schedulerTaskService->checkJobs($jobs, new \DateTime("now"));

        $this->assertEquals(1, $jobsExecuted);
    }


    /**
     * @test
     */
    public function itShouldExecuteNothing(): void
    {
        $jobs = [];
        $factory = new JobFactory();
        $now = new \DateTime("now");
        $params = [$now->format('i') > 30 ? "10" : "40","*","*","*","*","ls"];
        $job = $factory->createJob($params);
        /**
         * @var array <Job> $jobs
         */
        $jobs[] = $job;

        $schedulerTaskService = new ScheduleTasksService();
        $jobsExecuted = $schedulerTaskService->checkJobs($jobs, new \DateTime("now"));

        $this->assertEquals(0, $jobsExecuted);
    }
}
