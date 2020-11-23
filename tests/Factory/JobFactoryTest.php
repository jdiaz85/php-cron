<?php

namespace App\Tests;

use App\Factory\JobFactory;
use PHPUnit\Framework\TestCase;
use App\Domain\Job;

class JobFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function itShouldCreateAJob(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertIsString($job->getMinute());
        $this->assertIsString($job->getHour());
        $this->assertIsString($job->getDay());
        $this->assertIsString($job->getMonth());
        $this->assertIsString($job->getDayWeek());
        $this->assertIsString($job->getCommand());
        $this->assertEquals("*", $job->getMinute());
        $this->assertEquals("*", $job->getHour());
        $this->assertEquals("*", $job->getDay());
        $this->assertEquals("*", $job->getMonth());
        $this->assertEquals("*", $job->getDayWeek());
        $this->assertEquals("command", $job->getCommand());
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMinuteMoreThan59(): void
    {
        $factory = new JobFactory();
        $params = ["60","*","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMinuteLessThan0(): void
    {
        $factory = new JobFactory();
        $params = ["-1","*","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMinuteStrange(): void
    {
        $factory = new JobFactory();
        $params = ["a","*","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobHourLessThan0(): void
    {
        $factory = new JobFactory();
        $params = ["*","-1","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobHourMoreThan23(): void
    {
        $factory = new JobFactory();
        $params = ["*","24","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobHourStrange(): void
    {
        $factory = new JobFactory();
        $params = ["*","a","*","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayMoreThan31(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","32","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayLessThan1(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","0","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayStrange(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","a","*","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMonthMoreThan12(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","13","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMonthLessThan1(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","0","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobMonthStrange(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","a","*","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayWeekMoreThan7(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","*","8","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayWeekLessThan1(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","*","0","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }

    /**
     * @test
     */
    public function itShouldntCreateAJobDayWeekStrange(): void
    {
        $factory = new JobFactory();
        $params = ["*","*","*","*","a","command"];
        $job = $factory->createJob($params);

        $this->assertEquals(null, $job);
    }
}
