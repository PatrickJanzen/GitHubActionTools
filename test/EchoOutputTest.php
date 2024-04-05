<?php

declare(strict_types=1);

namespace GitHubActionTools\Test;

use GitHubActionTools\Logger\EchoOutput;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(EchoOutput::class)]
class EchoOutputTest extends TestCase
{
    #[Test]
    public function outputTest(): void
    {
        $this->expectOutputString('foo' . PHP_EOL);
        $subject = new EchoOutput();
        $subject->writeln('foo');
    }
}
