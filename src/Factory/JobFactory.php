<?php

namespace App\Factory;

use App\Domain\Job;
use App\Utils\Utils;

class JobFactory
{

    /**
     * @param array <string> $params
     * @return Job
     */
    public function createJob(array $params): ?Job
    {
        if ($this->validateParams(...$params)) {
            return new Job(...$params);
        }

        return null;
    }

    /**
     * @param string $minute
     * @param string $hour
     * @param string $day
     * @param string $month
     * @param string $dayWeek
     * @param string $command
     * @return bool
     */
    private function validateParams(string $minute, string $hour, string $day, string $month, string $dayWeek, string $command): bool
    {
        if ($this->validateMinute($minute) and
            $this->validateHour($hour) and
            $this->validateDay($day) and
            $this->validateMonth($month) and
            $this->validateDayWeek($dayWeek)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $minute
     * @return bool
     */
    private function validateMinute(string $minute): bool
    {
        if ($minute == "*" or
            (is_numeric($minute) and Utils::betweenWithIncludedExtremes((int) $minute, Job::MIN_MAX_MINUTE["MIN"], Job::MIN_MAX_MINUTE["MAX"]))) {
            return true;
        }

        return false;
    }

    /**
     * @param string $hour
     * @return bool
     */
    private function validateHour(string $hour): bool
    {
        if ($hour == "*" or
            (is_numeric($hour) and Utils::betweenWithIncludedExtremes((int) $hour, Job::MIN_MAX_HOUR["MIN"], Job::MIN_MAX_HOUR["MAX"]))) {
            return true;
        }

        return false;
    }

    /**
     * @param string $day
     * @return bool
     */
    private function validateDay(string $day): bool
    {
        if ($day == "*" or
            (is_numeric($day) and Utils::betweenWithIncludedExtremes((int) $day, Job::MIN_MAX_DAY["MIN"], Job::MIN_MAX_DAY["MAX"]))) {
            return true;
        }

        return false;
    }

    /**
     * @param string $month
     * @return bool
     */
    private function validateMonth(string $month): bool
    {
        if ($month == "*" or
            (is_numeric($month) and Utils::betweenWithIncludedExtremes((int) $month, Job::MIN_MAX_MONTH["MIN"], Job::MIN_MAX_MONTH["MAX"]))) {
            return true;
        }

        return false;
    }

    /**
     * @param string $dayWeek
     * @return bool
     */
    private function validateDayWeek(string $dayWeek): bool
    {
        if ($dayWeek == "*" or
            (is_numeric($dayWeek) and Utils::betweenWithIncludedExtremes((int) $dayWeek, Job::MIN_MAX_DAY_WEEK["MIN"], Job::MIN_MAX_DAY_WEEK["MAX"]))) {
            return true;
        }

        return false;
    }
}
