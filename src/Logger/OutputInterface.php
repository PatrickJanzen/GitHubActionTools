<?php

declare(strict_types=1);

namespace GitHubWorkflowTools\Logger;

interface OutputInterface
{
    public function writeln(string $output): void;
}
