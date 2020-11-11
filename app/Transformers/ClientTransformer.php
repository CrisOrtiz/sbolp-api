<?php
namespace App\Transformers;
use App\Models\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
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
     * @param Client $Client
     * @return array
     */
    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'address' => $client->address,
            'nit_ci' => $client->nit_ci,
            'phone' => $client->phone,
            'email' => $client->email
        ]; 
    }
   
}
