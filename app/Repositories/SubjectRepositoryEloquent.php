<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubjectRepository;
use App\Entities\Subject;
use App\Validators\SubjectValidator;

/**
 * Class SubjectRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubjectRepositoryEloquent extends BaseRepository implements SubjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subject::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SubjectValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
