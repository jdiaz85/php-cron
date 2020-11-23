<?php

namespace App\Service;

use App\Domain\Job;
use App\Factory\JobFactory;
use Symfony\Component\HttpFoundation\File\File;

class ReadFileService
{
    /**
     * @var File $file
     */
    private File $file;
    /**
     * @var array <string> $lines
     */
    private array $lines;

    /**
     * ReadFileService constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
        $this->lines = [];
    }

    /**
     * @return array <Job>
     */
    public function readLines(): array
    {
        $content = file_get_contents((string) $this->file);
        if ($content) {
            $this->lines = explode("\n", $content);
            $this->quitCommentLines();

            return $this->createJobs();
        }
        return [];
    }

    /**
     *
     */
    private function quitCommentLines(): void
    {
        foreach ($this->lines as $index => $line) {
            $line = trim($line);
            if (strlen($line) == 0 or $line[0] == "#") {
                unset($this->lines[$index]);
            }
        }
    }

    /**
     * @return array <Job>
     */
    private function createJobs(): array
    {
        $jobs = [];
        $jobFactory = new JobFactory();
        foreach ($this->lines as $line) {
            $params = $this->createArrayLine($line);
            if ($params) {
                $job = $jobFactory->createJob($params);
                if ($job) {
                    $jobs[]=$job;
                }
            }
        }

        return $jobs;
    }

    /**
     * @param string $line
     * @return array <string> |null
     */
    private function createArrayLine(string $line): ?array
    {
        $parts = [];
        for ($i=0; $i < Job::PARAMS - 1; $i++) {
            $pos = strpos($line, " ");
            if ($pos) {
                $parts[$i] = substr($line, 0, $pos);
                $line = substr($line, $pos+1);
                if (!$line) {
                    return null;
                }
            } else {
                return null;
            }
        }
        $parts[$i] = $line;

        return $parts;
    }
}
