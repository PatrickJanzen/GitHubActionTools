<?php

declare(strict_types=1);

namespace GitHubWorkflowTools\Test;

use GitHubWorkflowTools\EchoOutput;
use PHPUnit\Framework\TestCase;

/**
 * @covers GitHubWorkflowTools\EchoOutput
 */
class EchoOutputTest extends TestCase
{
    /**
     * @test
     */
    public function outputTest()
    {
        $this->expectOutputString('foo' . PHP_EOL);
        $subject = new EchoOutput();
        $subject->writeln('foo');

    }
}
