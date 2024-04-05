<?php

declare(strict_types=1);

namespace GitHubActionTools\Test\Logger;

use Generator;
use GitHubActionTools\Logger\ActionLogger;
use GitHubActionTools\Logger\OutputInterface;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ActionLogger::class)]
class ActionLoggerTest extends MockeryTestCase
{
    public static function data(): Generator
    {
        yield ['startGroup', ['group1'], '::group::group1'];
        yield ['write', ['test'], 'test'];
        yield ['warning', ['warning test', 'somefile.src', 0, 10, 0, 1, 'title'], '::warning file=somefile.src,line=0,endLine=1,title=title,col=0,endCol=10::warning test'];
        yield ['notice', ['notice test'], '::notice::notice test'];
        yield ['error', ['error test'], '::error::error test'];
        yield ['debug', ['debug test'], '::debug::debug test'];
        yield ['log', ['unknown', 'unknown test'], '::unknown::unknown test'];
        yield ['endGroup', [], '::endgroup::'];
        yield ['startGroup', [null], '::group::group 1'];
    }

    #[Test]
    #[DataProvider('data')]
    public function loggerTest(string $method, array $logData, string $expectation): void
    {
        $this->expectOutputString('');

        $output = mock(OutputInterface::class);
        $output->shouldReceive('writeln')->once()->with($expectation);

        $subject = new ActionLogger($output);
        $this->assertTrue(method_exists($subject, $method));
        $this->assertTrue(is_callable([$subject, $method]));

        $subject->$method(...$logData);
    }
}
