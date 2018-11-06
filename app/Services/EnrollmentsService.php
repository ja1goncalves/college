<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 12:59
 */

namespace App\Services;

use App\Repositories\EnrollmentRepository;
use App\Services\Traits\CrudMethods;


class EnrollmentsService extends AppService
{
    use CrudMethods;
    /**
     * @var EnrollmentRepository
     */
    protected $repository;
    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $request
     * @return array|\Illuminate\Http\JsonResponse|mixed
     */
    public function insertNote(array $request)
    {
        if($request['student_id'] && $request['subject_id']){
            if($request['note_1'] || $request['note_2']){
                $enrollment = $this->repository->findByStudentAndSubject($request['student_id'], $request['subject_id']);
                if($enrollment){
                    $notas = [
                        'note_1' => $request['note_1'] ?? null,
                        'note_2' => $request['note_2'] ?? null
                    ];
                    return $this->update($notas, $enrollment->id);
                }return response()->json(['error' => false, 'message' => 'Usuário não existe'], 500);
            }
        }else
            return response()->json(['error' => true, 'message' => 'Falta de dados'], 500);
        return response()->json(['error' => true, 'message' => 'Algo de errado não está certo'], 500);
    }

    public function mediaStudentInSubject(array $request)
    {
        if($request['student_id'] && $request['subject_id']) {
            $enrollment = $this->repository->findByStudentAndSubject($request['student_id'], $request['subject_id']);
            if($enrollment){
                if($enrollment->note_1 && $enrollment->note_2){
                    $media = ($enrollment->note_1 + $enrollment->note_2)/2;
                    return response()->json(['error' => false, 'media' => $media], 200);
                }else
                    return response()->json(['error' => true, 'message' => 'Falta notas no aluno'], 500);
            }else
                return response()->json(['error' => true, 'message' => 'Esse usuário não existe'], 500);
        }
        return response()->json(['error' => true, 'message' => 'Algo de errado, não está certo'], 500);
    }

    public function mediaGeralStudent(array $request)
    {
        if($request['student_id']){
            $enrollments = $this->find('student_id', $request['student_id']);
            $sum_notes = 0;
            $count = 0;
            foreach ($enrollments as $enrollment){
                if($enrollment->note_1 && $enrollment->note_2){
                    $sum_notes += ($enrollment->note_1 + $enrollment->note_2)/2;
                    $count ++;
                }else
                    return response()->json(['error' => true, 'message' => 'Faltam notas'], 500);

            }
            return response()->json(['error' => false, 'message' => $sum_notes/$count], 200);
        }
        return response()->json(['error' => true, 'message' => 'Algo de errado, não está certo'], 500);
    }

}
