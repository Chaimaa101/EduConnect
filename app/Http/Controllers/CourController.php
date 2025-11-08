<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware ;
use Illuminate\Support\Facades\Gate ;

class CourController extends Controller 
{  
  
    public function index()
    {
         return Cour::with('teacher')->get();
    }
    public function store(Request $request)
    {
        Gate::authorize('create', Cour::class);
        $infos = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
        ]);
        $cour = $request->user()->courses()->create($infos);

        return [
            'message' => 'cour was added',
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
        Gate::authorize('create', Cour::class);
        $infos = $request->validate([
            'name' => 'max:255',
            'description' => 'max:255',
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
       Gate::authorize('create', Cour::class);
        $cour->delete();
        return ['message' => 'cour was deleted'];
    }
}
