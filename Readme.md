# GitHubActionTools

Helper Library for GitHub actions written in PHP

only feature so far:

Logger class for GitHub: 
```php
$logger->debug('Hello World');
$logger->notice('Hello World', filename: 'Test.php', line: 12);
```
leads to the output of: 
```
::debug::Hello World
::notice file=Test.php,line=12::Hello World
```

