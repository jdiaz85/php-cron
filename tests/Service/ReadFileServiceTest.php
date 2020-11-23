<?php

namespace App\Tests;

use App\Service\ReadFileService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;
use App\Domain\Job;

class ReadFileServiceTest extends TestCase
{

    /**
     * @test
     */
    public function readFileCorrectly1Job(): void
    {
        $file = new File("var/files/test1.cron");
        $readFileService = new ReadFileService($file);
        $jobs = $readFileService->readLines();


        $this->assertCount(1, $jobs);
        $this->assertInstanceOf(Job::class, $jobs[0]);
    }

    /**
     * @test
     */
    public function readFileCorrectly0Job1Comment(): void
    {
        $file = new File("var/files/test2.cron");
        $readFileService = new ReadFileService($file);
        $jobs = $readFileService->readLines();


        $this->assertCount(0, $jobs);
    }

    /**
     * @test
     */
    public function readFileCorrectly0Job1LineBad(): void
    {
        $file = new File("var/files/test3.cron");
        $readFileService = new ReadFileService($file);
        $jobs = $readFileService->readLines();


        $this->assertCount(0, $jobs);
    }
}
