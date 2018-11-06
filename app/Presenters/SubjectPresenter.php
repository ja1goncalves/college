<?php

namespace App\Presenters;

use App\Transformers\SubjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SubjectPresenter.
 *
 * @package namespace App\Presenters;
 */
class SubjectPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SubjectTransformer();
    }
}
