<?php

declare(strict_types=1);

namespace GitHubActionTools\Logger;

class ActionLogger
{
    const GROUP = 'group';
    const NOTICE = 'notice';
    const WARNING = 'warning';
    const ERROR = 'error';
    const DEBUG = 'debug';
    const END_GROUP = 'endgroup';

    private static int $groupCounter = 0;

    public function __construct(private OutputInterface $out)
    {
    }

    private static function addIfSet(array &$data, string $template, string|int|null $value): void
    {
        if ($value !== null) {
            $data[] = sprintf($template, $value);
        }
    }

    public function debug(string $message): void
    {
        $this->log(self::DEBUG, $message);
    }

    public function log(string $type, string $message = '', ?string $filename = null, ?int $col = null, ?int $endCol = null, ?int $line = null, ?int $endLine = null, ?string $title = null): void
    {
        $data = [];

        self::addIfSet($data, 'file=%s', $filename);
        self::addIfSet($data, 'line=%s', $line);
        self::addIfSet($data, 'endLine=%s', $endLine);
        self::addIfSet($data, 'title=%s', $title);
        self::addIfSet($data, 'col=%s', $col);
        self::addIfSet($data, 'endCol=%s', $endCol);

        $payload = implode(',', $data);
        if (!empty($payload)) {
            $payload = ' ' . $payload;
        }
        $this->write(sprintf('::%s%s::%s', $type, $payload, $message));
    }

    public function write(string $output): void
    {
        $this->out->writeln($output);
    }

    public function notice(string $message, ?string $filename = null, ?int $col = null, ?int $endCol = null, ?int $line = null, ?int $endLine = null, ?string $title = null): void
    {
        $this->log(self::NOTICE, $message, $filename, $col, $endCol, $line, $endLine, $title);
    }

    public function warning(string $message, ?string $filename = null, ?int $col = null, ?int $endCol = null, ?int $line = null, ?int $endLine = null, ?string $title = null): void
    {
        $this->log(self::WARNING, $message, $filename, $col, $endCol, $line, $endLine, $title);
    }

    public function error(string $message, ?string $filename = null, ?int $col = null, ?int $endCol = null, ?int $line = null, ?int $endLine = null, ?string $title = null): void
    {
        $this->log(self::ERROR, $message, $filename, $col, $endCol, $line, $endLine, $title);
    }

    public function startGroup(?string $groupName = null): void
    {
        $this->log(self::GROUP, $groupName ?? sprintf('group %d', ++self::$groupCounter));
    }

    public function endGroup(): void
    {
        $this->log(self::END_GROUP);
    }
}
