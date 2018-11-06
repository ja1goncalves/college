<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Enrollment;

/**
 * Class EnrollmentTransformer.
 *
 * @package namespace App\Transformers;
 */
class EnrollmentTransformer extends TransformerAbstract
{
    /**
     * Transform the Enrollment entity.
     *
     * @param \App\Entities\Enrollment $model
     *
     * @return array
     */
    public function transform(Enrollment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
