<?php


namespace App\Repository;


use App\Services\FlightService;
use Illuminate\Support\Collection;

class GroupRepository
{

    public function groups($flights): \Illuminate\Support\Collection
    {
        $groupsByFare = $this->groupFlightsByFare($flights);
        $groupsByPrice = $this->filterByTotalPrice($groupsByFare);
        return $this->formattedGroups($groupsByPrice)->sortBy('totalPrice')->values();
    }

    private function formattedGroups($groups): Collection{
        return $groups->map(function ($item, $key){
            return [
                'uniqueId' => uniqid(),
                'totalPrice' => $this->calculateTotalPrice($item),
                'outbound' => $this->filterFlightsByOutbound($item),
                'inbound'  => $this->filterFlightsByInbound($item),
            ];
        })->values();
    }

    private function filterByTotalPrice($groups): \Illuminate\Support\Collection
    {
        $filter = [];
        foreach ($groups as $group){
            $lastOutboundValue = $lastInboundValue = 0;
            foreach ($group as $key => $flight){
                $firstInboundPrice = $this->filterFlightsByInbound($group)->first()['price'];
                $firstOutboundPrice = $this->filterFlightsByOutbound($group)->first()['price'];
                $expectedValue = $firstInboundPrice + $firstOutboundPrice ?? 0;
                if($key >= 2){
                    $actualValue = $expectedValue;

                    if($flight['outbound']){
                        $actualValue = $firstInboundPrice  + $flight['price'];
                    }

                    // You have no idea, how bad I feel for doing an "elseif".
                    elseif($flight['inbound']){
                        $actualValue = $firstOutboundPrice  + $flight['price'];
                    }

                    if($actualValue != $expectedValue){
                        unset($group[$key]);

                        if($flight['outbound']){
                            $filter[$actualValue] = $this->filterFlightsByInbound($group)->merge(collect([$flight]));
                        }

                        elseif($flight['inbound']){
                            $filter[$actualValue]  = $this->filterFlightsByOutbound($group)->merge(collect([$flight]));
                        }

                    }
                }
            }
        }

        return collect($groups->merge(collect($filter)->values()->unique()));
    }

    public function calculateTotalPrice($group): float
    {
        $firstOutbound = $this->filterFlightsByOutbound($group)->first();
        $firstInbound  = $this->filterFlightsByInbound($group)->first();

        $prices = [$firstOutbound['price'] ?? 0.00, $firstInbound['price'] ?? 0.00];

        return collect($prices)->sum();
    }

    public function groupFlightsByFare($flights = []): \Illuminate\Support\Collection
    {
        return collect($flights)->groupBy(['fare'])->values();
    }

    public function filterFlightsByOutbound($group): \Illuminate\Support\Collection
    {
        return collect($group)->filter(function ($item) {
            return $item['outbound'];
        })->values();
    }

    public function filterFlightsByInbound($group): \Illuminate\Support\Collection
    {
        return collect($group)->filter(function ($item) {
            return $item['inbound'];
        })->values();
    }
}
