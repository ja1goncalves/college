<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 13:01
 */

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Repositories\EnrollmentRepository;
use App\Services\Traits\CrudMethods;

class StudentsService extends AppService
{
    use CrudMethods;
    /**
     * @var StudentRepository
     */
    protected $repository;
    /**
     * @var EnrollmentRepository
     */
    protected $enrollments;
    public function __construct(StudentRepository $repository, EnrollmentRepository $enrollments)
    {
        $this->repository = $repository;
        $this->enrollments = $enrollments;
    }

    public function show($id)
    {
        $student = $this->find($id);
        if($student){
            $enrollments = $this->enrollments->findByField('students_id', $student->id);
            $subjects = [];
            foreach ($enrollments as $enrollment){
                $subjects[] = [
                    'name' => (SubjectsService::find($enrollments->subject_id))->name,
                    'nota_1' => $enrollment->note_1,
                    'nota_2' =>$enrollment->note_2,
                ];
            }
            return response()->json([
                'error' => false,
                'student' => $student->name,
                'subjects' => $subjects,
                'media geral' => EnrollmentsService::mediaGeralStudent(['student_id' => $student->id]),
            ]);
        }
        return response()->json(['error' => true, 'message' => 'Algo de errado, não está certo'], 500);
    }
}
