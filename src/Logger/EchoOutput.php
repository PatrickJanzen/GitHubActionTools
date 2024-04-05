<?php

declare(strict_types=1);

namespace GitHubActionTools\Logger;

class EchoOutput implements OutputInterface
{
    public function writeln(string $output): void
    {
        echo $output . PHP_EOL;
    }
}
