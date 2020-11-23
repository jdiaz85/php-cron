<?php

namespace App\Domain;

class Job
{
    const PARAMS = 6;
    const MIN_MAX_MINUTE = ["MIN" => 0, "MAX" => 59];
    const MIN_MAX_HOUR = ["MIN" => 0, "MAX" => 23];
    const MIN_MAX_DAY = ["MIN" => 1, "MAX" => 31];
    const MIN_MAX_MONTH = ["MIN" => 1, "MAX" => 12];
    const MIN_MAX_DAY_WEEK = ["MIN" => 1, "MAX" => 7];
    /**
     * @var string $dayWeek
     */
    protected string $dayWeek;

    /**
     * @var string $month
     */
    protected string $month;

    /**
     * @var string $day
     */
    protected string $day;

    /**
     * @var string $hour
     */
    protected string $hour;

    /**
     * @var string $minute
     */
    protected string $minute;

    /**
     * @var string $command
     */
    protected string $command;

    /**
     * Job constructor.
     * @param string $dayWeek
     * @param string $month
     * @param string $day
     * @param string $hour
     * @param string $minute
     * @param string $command
     */
    public function __construct(string $minute, string $hour, string $day, string $month, string $dayWeek, string $command)
    {
        $this->minute = $minute;
        $this->hour = $hour;
        $this->day = $day;
        $this->month = $month;
        $this->dayWeek = $dayWeek;
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getDayWeek(): string
    {
        return $this->dayWeek;
    }

    /**
     * @param string $dayWeek
     */
    public function setDayWeek(string $dayWeek): void
    {
        $this->dayWeek = $dayWeek;
    }

    /**
     * @return string
     */
    public function getMonth(): string
    {
        return $this->month;
    }

    /**
     * @param string $month
     */
    public function setMonth(string $month): void
    {
        $this->month = $month;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getHour(): string
    {
        return $this->hour;
    }

    /**
     * @param string $hour
     */
    public function setHour(string $hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return string
     */
    public function getMinute(): string
    {
        return $this->minute;
    }

    /**
     * @param string $minute
     */
    public function setMinute(string $minute): void
    {
        $this->minute = $minute;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @param string $command
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }
}
