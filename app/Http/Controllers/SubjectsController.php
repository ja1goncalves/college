<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SubjectCreateRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Repositories\SubjectRepository;
use App\Validators\SubjectValidator;

/**
 * Class SubjectsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SubjectsController extends Controller
{
    /**
     * @var SubjectRepository
     */
    protected $repository;

    /**
     * @var SubjectValidator
     */
    protected $validator;

    /**
     * SubjectsController constructor.
     *
     * @param SubjectRepository $repository
     * @param SubjectValidator $validator
     */
    public function __construct(SubjectRepository $repository, SubjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $subjects = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $subjects,
            ]);
        }

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubjectCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SubjectCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $subject = $this->repository->create($request->all());

            $response = [
                'message' => 'Subject created.',
                'data'    => $subject->toArray(),
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
        $subject = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $subject,
            ]);
        }

        return view('subjects.show', compact('subject'));
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
        $subject = $this->repository->find($id);

        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SubjectUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $subject = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Subject updated.',
                'data'    => $subject->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Subject deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Subject deleted.');
    }
}
