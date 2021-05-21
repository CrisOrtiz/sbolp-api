<?php
namespace App\Transformers;
use App\Models\Patient;
use League\Fractal\TransformerAbstract;

class PatientTransformer extends TransformerAbstract
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
     * @param Patient $patient
     * @return array
     */
    public function transform(Patient $patient)
    {
        return [
            'id' => $patient->id,
            'ci' => $patient->ci,
            'name' => $patient->name,
            'last_name' => $patient->last_name
        ];
    }
}