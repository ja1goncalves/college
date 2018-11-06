<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 13:01
 */

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Services\Traits\CrudMethods;

class StudentsService extends AppService
{
    use CrudMethods;
    /**
     * @var StudentRepository
     */
    protected $repository;
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

}
