<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAircraftRequest;
use App\Http\Requests\UpdateAircraftRequest;
use App\Repositories\AircraftRepository;
use App\Repositories\FareRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AircraftController extends BaseController
{
    /** @var  AircraftRepository */
    private $aircraftRepository, $fareRepository;

    protected function getAvailFares($all_fares, $attached_fares)
    {
        $retval = [];
        $avail_fares = $all_fares->except($attached_fares->modelKeys());
        foreach ($avail_fares as $fare) {
            $retval[$fare->id] = $fare->name.
                                 ' (price: '.$fare->price.
                                 ', cost: '.$fare->cost.
                                 ', capacity: '.$fare->capacity.')';
        }

        return $retval;
    }

    public function __construct(AircraftRepository $aircraftRepo, FareRepository $fareRepo)
    {
        $this->fareRepository = $fareRepo;
        $this->aircraftRepository = $aircraftRepo;
    }

    /**
     * Display a listing of the Aircraft.
     */
    public function index(Request $request)
    {
        $this->aircraftRepository->pushCriteria(new RequestCriteria($request));
        $aircraft = $this->aircraftRepository->all();

        return view('admin.aircraft.index')
            ->with('aircraft', $aircraft);
    }

    /**
     * Show the form for creating a new Aircraft.
     */
    public function create()
    {
        return view('admin.aircraft.create');
    }

    /**
     * Store a newly created Aircraft in storage.
     */
    public function store(CreateAircraftRequest $request)
    {
        $input = $request->all();

        $aircraft = $this->aircraftRepository->create($input);

        Flash::success('Aircraft saved successfully.');
        return redirect(route('admin.aircraft.index'));
    }

    /**
     * Display the specified Aircraft.
     */
    public function show($id)
    {
        $aircraft = $this->aircraftRepository->findWithoutFail($id);

        if (empty($aircraft)) {
            Flash::error('Aircraft not found');
            return redirect(route('admin.aircraft.index'));
        }

        $attached_fares = $aircraft->fares;
        $all_fares = $this->fareRepository->all();
        $avail_fares = $this->getAvailFares($all_fares, $attached_fares);

        return view('admin.aircraft.show')
                ->with('aircraft', $aircraft)
                ->with('attached_fares', $attached_fares)
                ->with('avail_fares', $avail_fares);
    }

    /**
     * Show the form for editing the specified Aircraft.
     */
    public function edit($id)
    {
        $aircraft = $this->aircraftRepository->findWithoutFail($id);

        if (empty($aircraft)) {
            Flash::error('Aircraft not found');
            return redirect(route('admin.aircraft.index'));
        }

        return view('admin.aircraft.edit')->with('aircraft', $aircraft);
    }

    /**
     * Update the specified Aircraft in storage.
     */
    public function update($id, UpdateAircraftRequest $request)
    {
        $aircraft = $this->aircraftRepository->findWithoutFail($id);

        if (empty($aircraft)) {
            Flash::error('Aircraft not found');
            return redirect(route('admin.aircraft.index'));
        }

        $aircraft = $this->aircraftRepository->update($request->all(), $id);

        Flash::success('Aircraft updated successfully.');

        return redirect(route('admin.aircraft.index'));
    }

    /**
     * Remove the specified Aircraft from storage.
     */
    public function destroy($id)
    {
        $aircraft = $this->aircraftRepository->findWithoutFail($id);

        if (empty($aircraft)) {
            Flash::error('Aircraft not found');
            return redirect(route('admin.aircraft.index'));
        }

        $this->aircraftRepository->delete($id);

        Flash::success('Aircraft deleted successfully.');

        return redirect(route('admin.aircraft.index'));
    }

    protected function return_fares_view($aircraft)
    {
        $aircraft->refresh();
        $attached_fares = $aircraft->fares;
        $all_fares = $this->fareRepository->all();
        $avail_fares = $this->getAvailFares($all_fares, $attached_fares);

        return view('admin.aircraft.fares')
               ->with('aircraft', $aircraft)
               ->with('attached_fares', $attached_fares)
               ->with('avail_fares', $avail_fares);
    }

    public function fares(Request $request)
    {
        $id = $request->id;

        $aircraft = $this->aircraftRepository->findWithoutFail($id);
        if (empty($aircraft)) {
            return view('admin.aircraft.fares')->with('fares', []);
        }

        $fare_svc = app('App\Services\FareService');

        if ($request->isMethod('get')) {
            return $this->return_fares_view($aircraft);
        }

        /**
         * update specific fare data
         */
        if ($request->isMethod('post')) {
            $fare = $this->fareRepository->findWithoutFail($request->fare_id);
            $fare_svc->setForAircraft($aircraft, $fare);
        }

        // update the pivot table with overrides for the fares
        elseif ($request->isMethod('put')) {
            $override = [];
            $fare = $this->fareRepository->findWithoutFail($request->fare_id);
            $override[$request->name] = $request->value;
            $fare_svc->setForAircraft($aircraft, $fare, $override);
        }

        // dissassociate fare from teh aircraft
        elseif ($request->isMethod('delete')) {
            $fare = $this->fareRepository->findWithoutFail($request->fare_id);
            $fare_svc->delFromAircraft($aircraft, $fare);
        }

        return $this->return_fares_view($aircraft);
    }
}
