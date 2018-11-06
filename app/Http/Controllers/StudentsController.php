<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests;
use App\Services\StudentsService;
use App\Validators\StudentValidator;

/**
 * Class StudentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentsController extends Controller
{
    use CrudMethods;
    /**
     * @var StudentsService
     */
    protected $service;
    /**
     * @var StudentValidator
     */
    protected $validator;
    /**
     * AddressesController constructor.
     *
     * @param StudentsService $repository
     * @param StudentValidator $validator
     */
    public function __construct(StudentsService $service, StudentValidator $validator)
    {
        $this->service    = $service;
        $this->validator  = $validator;
    }
}
