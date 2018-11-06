<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Subject;

/**
 * Class SubjectTransformer.
 *
 * @package namespace App\Transformers;
 */
class SubjectTransformer extends TransformerAbstract
{
    /**
     * Transform the Subject entity.
     *
     * @param \App\Entities\Subject $model
     *
     * @return array
     */
    public function transform(Subject $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
