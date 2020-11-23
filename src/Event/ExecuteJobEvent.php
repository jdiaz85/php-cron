<?php

namespace App\Event;

use \Symfony\Contracts\EventDispatcher\Event;

class ExecuteJobEvent extends Event
{

    public const NAME = 'job.execute';
    /**
     * @var string $command
     */
    private string $command;

    /**
     * ExecuteJobEvent constructor.
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
