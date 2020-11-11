<?php
namespace App\Transformers;
use App\Models\Jelpi;
use League\Fractal\TransformerAbstract;

class JelpiTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param Article $Article
     * @return array
     */
    public function transform(Jelpi $jelpi)
    {
        return [
            'id' => $jelpi->id,
            'firstname' => $jelpi->firstname,
            'lastname' => $jelpi->lastname,
            'email' => $jelpi->email,
            'ci' => $jelpi->ci
        ];
    }

}
