<?php
/**
 * Created by PhpStorm.
 * User: jirka.martinec
 * Date: 27.12.2020
 * Time: 21:33
 */

namespace App\Model\Repositories;


use App\Model\Entities\User;

class UserRepository extends BaseRepository
{
    protected const TABLE = 'user';

    /**
     * @var string
     */
    protected string $entityClass = User::class;
}