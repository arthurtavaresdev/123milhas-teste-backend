<?php


namespace App\Http\Controllers;


use App\Repository\GroupRepository;
use App\Services\FlightService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
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

    public function index(): JsonResponse
    {
        $flights = $this->service->fetchFlights();
        try{
            $groups = $this->repository->groups($flights);
            return response()->json($groups);
        } catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }

    }

}
