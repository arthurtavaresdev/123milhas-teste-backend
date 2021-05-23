<?php


namespace App\Http\Controllers;

use App\Http\Resources\FlightResource;
use App\Repository\GroupRepository;
use App\Services\FlightService;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class FlightController extends Controller
{
    /**
     * @var GroupRepository
     */
    private $repository;

    /**
     * @var FlightService
     */
    private $service;

    /**
     * FlightController constructor.
     */
    public function __construct()
    {

        $this->service = new FlightService();
        $this->repository = new GroupRepository();
    }

    public function index()
    {
        try{
            $flights = $this->service->fetchFlights();
            $groups = $this->repository->groups($flights);

            $resource = (object)[
                'flights' => $flights,
                'groups' => $groups
            ];

            return new FlightResource($resource);
        } catch (Exception|GuzzleException $exception) {
            return response()->json(['message' => $exception->getMessage() , 'line' => $exception->getLine()], 400);
        }
    }

}
