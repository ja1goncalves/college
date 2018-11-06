<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EnrollmentCreateRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use App\Repositories\EnrollmentRepository;
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
     * @var EnrollmentRepository
     */
    protected $service;

    /**
     * @var EnrollmentValidator
     */
    protected $validator;

    /**
     * EnrollmentsController constructor.
     *
     * @param EnrollmentRepository $repository
     * @param EnrollmentValidator $validator
     */
    public function __construct(EnrollmentRepository $service, EnrollmentValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->service->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $enrollments = $this->service->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $enrollments,
            ]);
        }

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EnrollmentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EnrollmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $enrollment = $this->service->create($request->all());

            $response = [
                'message' => 'Enrollment created.',
                'data'    => $enrollment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enrollment = $this->service->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $enrollment,
            ]);
        }

        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enrollment = $this->service->find($id);

        return view('enrollments.edit', compact('enrollment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EnrollmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EnrollmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $enrollment = $this->service->update($request->all(), $id);

            $response = [
                'message' => 'Enrollment updated.',
                'data'    => $enrollment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Enrollment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Enrollment deleted.');
    }
}
