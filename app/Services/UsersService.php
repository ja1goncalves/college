<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 13:03
 */

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
/**
 * Class BankAccountService
 * @package App\Services
 */
class UsersService extends AppService
{
    use CrudMethods;
    /**
     * @var UserRepository
     */
    protected $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

}
