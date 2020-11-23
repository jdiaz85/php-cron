<?php

namespace App\Service;

use App\Domain\Job;
use App\Event\ExecuteJobEvent;
use App\EventListener\ExecuteJobListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ScheduleTasksService
{
    private EventDispatcher $eventDispatcher;

    /**
     * ScheduleTasksService constructor.
     */
    public function __construct()
    {
        $this->eventDispatcher = new EventDispatcher();
        $this->eventDispatcher->addSubscriber(new ExecuteJobListener());
    }


    /**
     * @param array <Job> $jobs
     * @param \DateTime $date
     * @return int
     */
    public function checkJobs(array $jobs, \DateTime $date): int
    {
        $count = 0;
        foreach ($jobs as $job) {
            if ($this->checkDateForTask($job, $date)) {
                $this->executeJob($job);
                $count++;
            };
        }

        return $count;
    }

    /**
     * @param Job $job
     * @param \DateTime $date
     * @return bool
     */
    private function checkDateForTask(Job $job, \DateTime $date): bool
    {
        if ($this->checkMinute($job->getMinute(), $date) and
            $this->checkHour($job->getHour(), $date) and
            $this->checkDay($job->getDay(), $date) and
            $this->checkMonth($job->getMonth(), $date) and
            $this->checkDayWeek($job->getDayWeek(), $date)) {
            return true;
        }

        return false;
    }

    /**
     * @param Job $job
     */
    private function executeJob(Job $job): void
    {
        $event = new ExecuteJobEvent($job->getCommand());
        $this->eventDispatcher->dispatch($event, ExecuteJobEvent::NAME);
    }

    /**
     * @param string $minute
     * @param \DateTime $date
     * @return bool
     */
    private function checkMinute(string $minute, \DateTime $date): bool
    {
        if ($minute == "*" or $minute == $date->format('i')) {
            return true;
        }

        return false;
    }

    /**
     * @param string $hour
     * @param \DateTime $date
     * @return bool
     */
    private function checkHour(string $hour, \DateTime $date): bool
    {
        if ($hour == "*" or $hour == $date->format('H')) {
            return true;
        }

        return false;
    }

    /**
     * @param string $day
     * @param \DateTime $date
     * @return bool
     */
    private function checkDay(string $day, \DateTime $date): bool
    {
        if ($day == "*" or $day == $date->format('d')) {
            return true;
        }

        return false;
    }

    /**
     * @param string $month
     * @param \DateTime $date
     * @return bool
     */
    private function checkMonth(string $month, \DateTime $date): bool
    {
        if ($month == "*" or $month == $date->format('m')) {
            return true;
        }

        return false;
    }

    /**
     * @param string $dayWeek
     * @param \DateTime $date
     * @return bool
     */
    private function checkDayWeek(string $dayWeek, \DateTime $date): bool
    {
        if ($dayWeek == "*" or $dayWeek == $date->format('N')) {
            return true;
        }

        return false;
    }
}
