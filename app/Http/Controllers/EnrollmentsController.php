<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests;
use App\Services\EnrollmentsService;
use App\Validators\EnrollmentValidator;
use Illuminate\Http\Request;

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
     * EnrollmentsController constructor.
     *
     * @param EnrollmentsService $service
     * @param EnrollmentValidator $validator
     */
    public function __construct(EnrollmentsService $service, EnrollmentValidator $validator)
    {
        $this->service    = $service;
        $this->validator  = $validator;
    }

    public function insertNotes(Request $request)
    {
        return $this->service->insertNote($request->all());
    }

    public function mediaGeralStudent(Request $request)
    {
        return $this->service->mediaGeralStudent($request->all());
    }

    public function mediaStudentInSubject(Request $request)
    {
        return $this->service->mediaStudentInSubject($request->all());
    }
}
