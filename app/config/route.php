<?php

/**
 * @author Bao
 */


use App\Controllers\IndexController;
use App\Controllers\StoreController;
use App\Controllers\MenuController;
use App\Controllers\ItemController;
use App\Controllers\UserController;



define('GET', 'GET');
define('POST', 'POST');

return [
    [GET, '', [IndexController::class, 'index']],
    [POST, '/verify', [IndexController::class, 'verify']],
    [POST, '/store/uuid', [StoreController::class, 'uuid']],
    [POST, '/store/get', [StoreController::class, 'get']],
    [POST, '/store/city', [StoreController::class, 'city']],
    [POST, '/store/district', [StoreController::class, 'district']],
    [POST, '/store/ward', [StoreController::class, 'ward']],
    [POST, '/store/getByAdmin', [StoreController::class, 'getStoreByAdmin']],
    [POST, '/store/update', [StoreController::class, 'update']],
    [POST, '/store/insert', [StoreController::class, 'insert']],

    [POST, '/menu/createAll', [MenuController::class, 'createAll']],

    [POST, '/user/login', [UserController::class, 'login']],

    [POST, '/menu/update', [MenuController::class, 'update']],
    [POST, '/menu/delete', [MenuController::class, 'delete']],
    [POST, '/menu/get', [MenuController::class, 'get']],

    [POST, '/item/update', [ItemController::class, 'update']],
    [POST, '/item/delete', [ItemController::class, 'delete']],
    [POST, '/item/get', [ItemController::class, 'get']],



];
