<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Permission;

class PermissionsRepository extends Repository
{

    public function __construct(Permission $permission)
    {
        $this->model=$permission;
    }


}