<?php

namespace App\Transformers;

use App\Models\Image;
use App\Models\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\ClinicCaseTransformer;
use Carbon\Carbon;

class ImageTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param Image $image
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'id' => $image->id,
            'rel_type' => $image->rel_type,
            'rel_id' => $image->rel_id,
            'image_url' => $image->image_url,
            'created_at' => $image->created_at,
        ];
    }
}
