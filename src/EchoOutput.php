<?php

declare(strict_types=1);

namespace GitHubWorkflowTools;

use GitHubWorkflowTools\OutputInterface;

class EchoOutput implements OutputInterface
{

    public function writeln(string $output): void
    {
        echo $output . PHP_EOL;
    }
}