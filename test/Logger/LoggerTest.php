<?php

declare(strict_types=1);

namespace GitHubWorkflowTools\Test\Logger;

use GitHubWorkflowTools\Logger\Logger;
use GitHubWorkflowTools\OutputInterface;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @covers \GitHubWorkflowTools\Logger\Logger
 */
class LoggerTest extends MockeryTestCase
{

    /**
     * @test
     * @dataProvider data
     */
    public function loggerTest(string $method, array $logData, string $expectation)
    {
        $output = mock(OutputInterface::class);

        $output->shouldReceive('writeln')->once()->with($expectation);

        $subject = new Logger($output);
        $this->assertTrue(method_exists($subject, $method));
        $this->assertTrue(is_callable([$subject, $method]));
        $subject->$method(...$logData);
    }

    public static function data(): \Generator
    {
        yield ['startGroup', ['group1'], '::group::group1'];
        yield ['write', ['test'], 'test'];
        yield ['warning', ['warning test', 'somefile.src', 0, 10, 0, 1, 'title'], '::warning file=somefile.src,line=0,endLine=1,title=title,col=0,endCol=10::warning test'];
        yield ['notice', ['notice test'], '::notice::notice test'];
        yield ['error', ['error test'], '::error::error test'];
        yield ['debug', ['debug test'], '::debug::debug test'];
        yield ['log', ['unknown', 'unknown test'], '::unknown::unknown test'];
        yield ['endGroup', [], '::endgroup::'];
        yield ['startGroup', [ null ], '::group::group 1'];
    }
}
