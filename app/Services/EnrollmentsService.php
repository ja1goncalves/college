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

}
