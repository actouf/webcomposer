<?php
require __DIR__ . '/../vendor/autoload.php'; // require composer/composer dependencies

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;

set_time_limit(900);

// Composer\Factory::getHomeDir() method
// needs COMPOSER_HOME environment variable set
putenv('COMPOSER_HOME=' . __DIR__ . '/../vendor/bin/composer');
putenv('SYMFONY_ENV=prod');

// call `composer install` command programmatically
$input = new ArrayInput(
    array(
        'command' => 'install',
        '--working-dir' => __DIR__.'/../',
        '--no-dev' => true,
        '--no-interaction' => true,
        '--verbose' => true,
        '--prefer-dist' => true,
        '--optimize-autoloader' => true,
    )
);
$output = new StreamOutput(fopen('php://output','w'));
echo "---Composer install Start---<hr /><pre>";
$application = new Application();
$application->setAutoExit(false); // prevent `$application->run` method from exiting the script
$application->run($input, $output);
echo "</pre><hr />---Composer install Done--";
