<?php

declare(strict_types=1);

namespace GitHubActionTools\Logger;

interface OutputInterface
{
    public function writeln(string $output): void;
}
