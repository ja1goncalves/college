<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 13:02
 */

namespace App\Services;

use App\Repositories\SubjectRepository;
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


}
