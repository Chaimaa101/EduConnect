<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use Illuminate\Http\Request;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cour::all();
        
    }
  public function store(Request $request)
    {
       $infos = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
        ]);
        $cour = Cour::create($infos);

        return ['message' => 'cour was added',
                'cour' =>  $cour
    ];
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Cour $cour)
    {
        return $cour;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cour $cour)
    {
         $infos = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
        ]);
        $cour->update($infos);

        return ['message' => 'cour was updated'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cour $cour)
    {
        $cour->delete();
        return ['message' => 'cour was deleted'];
     }
}
