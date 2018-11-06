<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\enrollmentRepository;
use App\Entities\Enrollment;
use App\Validators\EnrollmentValidator;

/**
 * Class EnrollmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EnrollmentRepositoryEloquent extends BaseRepository implements EnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Enrollment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EnrollmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByStudentAndSubject($student_id, $subject_id)
    {
        $this->findWhere(
            [
                'student_id' => $student_id,
                'subject_id' => $subject_id,
            ]
        );
    }
    
}
