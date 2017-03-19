<?php

// DIC
$container = $app->getContainer();

// Monolog
$container['logger'] = function (\Slim\Container $c) {

    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);

    $handler = new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG);

    $handler->setFormatter(new Monolog\Formatter\LineFormatter(
            "[%datetime%] %level_name% > %message% - %context% - %extra%\n"
    ));

    $logger->pushHandler($handler);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushProcessor(new Monolog\Processor\WebProcessor);

    return $logger;
};

//banco de dados postgres
$container['db'] = function (\Slim\Container $c) {

    $settings = $c->get('settings')['database'];
    $pdo = new \PDO("{$settings['driver']}:host={$settings['host']};port={$settings['port']};dbname={$settings['database']}", $settings['username'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['session'] = function ($c) {
  return new \SlimSession\Helper;
};

// Injeta o container no Base controller
$container['Base'] = function ($c) {
    return new Base($c);
};
