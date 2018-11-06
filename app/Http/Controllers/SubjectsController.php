<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests;
use App\Services\SubjectsService;
use App\Validators\SubjectValidator;
use Illuminate\Http\Request;


/**
 * Class SubjectsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SubjectsController extends Controller
{
    use CrudMethods;
    /**
     * @var SubjectsService
     */
    protected $service;
    /**
     * @var SubjectValidator
     */
    protected $validator;
    /**
     * AddressesController constructor.
     *
     * @param SubjectsService $repository
     * @param SubjectValidator $validator
     */
    public function __construct(SubjectsService $service, SubjectValidator $validator)
    {
        $this->service    = $service;
        $this->validator  = $validator;
    }

    public function showWithStudents(Request $request)
    {
        return $this->service->detailsWithStudent($request->get('subject_id'));
    }
}
