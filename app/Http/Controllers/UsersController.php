<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\UsersService;
use App\Validators\UserValidator;
use App\Http\Controllers\Traits\CrudMethods;
use Illuminate\Http\Request;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    use CrudMethods;
    /**
     * @var UsersService
     */
    protected $service;
    /**
     * @var UserValidator
     */
    protected $validator;
    /**
     * UsersController constructor.
     * @param UsersService $service
     * @param UserValidator $validator
     */
    public function __construct(UsersService $service, UserValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    public function login(Request $request)
    {
        return response()->json($this->service->login($request->all()), 200);
    }
}
