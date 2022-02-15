<?php


use Decorator\Repository\UserCacheRepository;
use Decorator\Repository\UserRepository as UserRepository;
use Decorator\Service\CacherService;
use Decorator\Service\UserService as UserService;

spl_autoload_register(function ($className){
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $className = preg_replace('/^Decorator/', '', $className);
    require_once __DIR__ . $className . '.php';
});

$userService = new UserService(new UserRepository());
$user = $userService->findByName('Павел');
var_dump($user);

echo '==============================================<br>';

$userCacheService = new UserService(
    new UserCacheRepository(       //UserCacheRepository - Это декоратор для UserRepository
        new CacherService(),       //т.к. в нем весь ф-л UserRepository + доб. ф-л. CacherService
        new UserRepository()
    )
);

$user = $userCacheService->findByName('Павел');
var_dump($user);
//$userCacheService->findByName('Андрей');