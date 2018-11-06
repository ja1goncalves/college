<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 13:02
 */

namespace App\Services;

use App\Repositories\SubjectRepository;
use App\Repositories\EnrollmentRepository;
use App\Services\Traits\CrudMethods;

class SubjectsService
{
    use CrudMethods;
    /**
     * @var SubjectRepository
     */
    protected $repository;
    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function detailsWithStudents(int $id)
    {
        $enrollments = EnrollmentRepository::findByField('subject_id', $id);
        if($enrollments){
            $students = [];
            foreach ($enrollments as $enrollment){
                $students[] = [
                    'name' => (StudentsService::find($enrollment->student_id))->name,
                    'media' => EnrollmentsService::mediaGeralStudent(['student_id' => $enrollment->student_id])
                ];
            }
            $medias = [];
            foreach ($students as $key => $student){
                $medias[$key] = $students['media'];
            }
            $students = array_multisort($medias, SORT_DESC, $students);
            return response()->json(['error' => false, 'students' => $students], 500);
        }
        return response()->json(['error' => true, 'message' => 'Algo de errado, não está certo'], 500);
    }

}
