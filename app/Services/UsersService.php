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

    public function login($request)
    {
        if($request['user'] && $request['password']){
            $user = $this->repository->findByField('user' , $request['user']);
            if($user){
                return $user->password == $request['password'];
            }else
                return ['error' => true, 'message' => 'Usuário inválido!'];
        }else
            return ['error' => true, 'message' => 'Falta de dados'];
    }
}
