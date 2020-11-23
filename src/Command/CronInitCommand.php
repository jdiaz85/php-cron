<?php

namespace App\Command;

use App\Service\ReadFileService;
use App\Service\ScheduleTasksService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\File\File;

class CronInitCommand extends Command
{
    protected static $defaultName = 'cron:init';
    protected ScheduleTasksService $scheduleTasksService;
    protected ReadFileService $readFileService;

    public function __construct(ScheduleTasksService $scheduleTasksService, string $name = null)
    {
        $this->scheduleTasksService = $scheduleTasksService;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Init personal scheduler')
            ->addArgument('fileName', InputArgument::REQUIRED, "File's name")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        /**
         * @var string $fileName
         */
        $fileName = $input->getArgument('fileName');

        if (!$fileName) {
            $io->error("File name it's necessary");
            return Command::FAILURE;
        }

        $now = new \DateTime("now");

        while (1) {
            $now = $now->modify("+ 1 minute");
            /**
             * @var ?File $file
             */
            $file = new File($fileName);

            if (!$file) {
                $io->error("File doesn't exists");

                return Command::FAILURE;
            }

            $readFileService = new ReadFileService($file);
            $jobs = $readFileService->readLines();
            $this->scheduleTasksService->checkJobs($jobs, new \DateTime("now"));

            time_sleep_until($now->getTimestamp());
        }
    }
}
