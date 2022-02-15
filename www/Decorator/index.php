<?php


use Decorator\Repository\UserRepository as UserRepository;
use Decorator\Service\UserService as UserService;

spl_autoload_register(function ($className){
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $className = preg_replace('/^Decorator/', '', $className);
    require_once __DIR__ . $className . '.php';
});

$userService = new UserService(new UserRepository());
$user = $userService->findByName('Павел');
var_dump($user);