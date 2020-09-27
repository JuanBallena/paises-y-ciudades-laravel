<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Collection;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public const WITHOUT_PARAMETERS = 1;
    public const WITH_PARAMETERS = 2;

    public function index()
    {
        $parameter_title = request('title');
        $parameter_place = request('place');
        $jobs = [];

        $case = (!$parameter_title && !$parameter_place) ? self::WITHOUT_PARAMETERS : self::WITH_PARAMETERS;

        switch ($case) {
            case self::WITHOUT_PARAMETERS:
                $jobs = Job::with(['country','state','city'])->get();
                break;

            case self::WITH_PARAMETERS:
                if ( $parameter_title && $parameter_place )
                {
                    $country = Country::searchByName($parameter_place)->first();
                    $state = State::searchByName($parameter_place)->first();
                    $city = City::searchByName($parameter_place)->first();

                    $jobs = Job::searchByCountryOrStateOrCity($country, $state, $city)
                        ->searchByTitleOrDescription($parameter_title)
                        ->with(['country','state','city'])
                        ->get();
                }
                else if ( $parameter_title )
                {
                    $jobs = Job::searchByTitleOrDescription($parameter_title)
                        ->with(['country','state','city'])
                        ->get();
                }
                else if ( $parameter_place )
                {
                    //$collection = new Collection();

                    $country = Country::searchByName($parameter_place)->first();
                    $state = State::searchByName($parameter_place)->first();
                    $city = City::searchByName($parameter_place)->first();

                    $jobs = Job::searchByCountryOrStateOrCity($country, $state, $city)
                        ->with(['country','state','city'])
                        ->get();

                    
                    // foreach ($cities as $city) {
                    //     $jobs_tmp = Job::searchByCountryOrStateOrCity($country, $state, $city)
                    //         ->with(['country','state','city'])
                    //         ->get();

                    //     foreach ($jobs_tmp as $job_tmp)
                    //     {
                    //         $collection->push($job_tmp);
                    //     }  
                    // }
                    //dd($collection);
                    //$jobs = $collection->all();
                    
                }
                //$jobs = $jobs->with(['country','state','city'])->get();
                break;
        }

        return view('jobs.index', [ "jobs" => $jobs ]);
    }

    public function redirectSearch(Request $request) {
        if (!$request->input_title && !$request->input_place)
        {
            return back();
        }
        //return redirect("/jobs?title=".$request->input_title."&place=".$request->input_place);
        return redirect()->route('jobs.index', [ 'title' => $request->input_title, 'place' => $request->input_place ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
