<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests;
use App\Services\EnrollmentsService;
use App\Validators\EnrollmentValidator;
/**
 * Class EnrollmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EnrollmentsController extends Controller
{

    use CrudMethods;
    /**
     * @var EnrollmentsService
     */
    protected $service;
    /**
     * @var EnrollmentValidator
     */
    protected $validator;
    /**
     * AddressesController constructor.
     *
     * @param EnrollmentsService $repository
     * @param EnrollmentValidator $validator
     */
    public function __construct(EnrollmentsService $service, EnrollmentValidator $validator)
    {
        $this->service    = $service;
        $this->validator  = $validator;
    }
}
