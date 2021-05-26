<?php
namespace App\Transformers;
use App\Models\ClinicCase;
use League\Fractal\TransformerAbstract;

class ClinicCaseTransformer extends TransformerAbstract
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
     * @param ClinicCase $clinicCase
     * @return array
     */
    public function transform(ClinicCase $clinicCase)
    {
        return [
            'id' => $clinicCase->id,
            'user_id' => $clinicCase->id,
            'name' => $clinicCase->name,
        ];
    }

    public function includeUser(ClinicCase $clinicCase)
    {
        $user = $clinicCase->user()->get();
        return $this->item($user, new UserTransformer());
    }
}