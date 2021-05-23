<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'flights' => $this->resource->flights,
            'groups' => $this->resource->groups,
            'totalGroups' => $this->resource->groups->count(),
            'totalFlights' => $this->resource->flights->count(),
            'cheapestPrice' => $this->resource->flights->min('price'),
            'cheapestGroup' => $this->resource->groups->min('totalPrice'),
        ];
    }

}
