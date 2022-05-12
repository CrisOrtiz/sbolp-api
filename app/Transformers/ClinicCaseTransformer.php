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
            'user_id' => $clinicCase->user_id,
            'title' => $clinicCase->title,
            'description' => $clinicCase->description,
            'diagnostic' => $clinicCase->diagnostic,
            'treatment_phase_one' => $clinicCase->treatment_phase_one,
            'procedure_phase_one' => $clinicCase->procedure_phase_one,
            'hasSecondPhase' => $clinicCase->hasSecondPhase,
            'treatment_phase_two' => $clinicCase->treatment_phase_two,
            'procedure_phase_two' => $clinicCase->procedure_phase_two,
            'conclusions' => $clinicCase->conclusions,
            'advices' => $clinicCase->advices,
            'status' => $clinicCase->status,
        ];
    }

    public function includeUser(ClinicCase $clinicCase)
    {
        $user = $clinicCase->user()->get();
        return $this->item($user, new UserTransformer());
    }
}