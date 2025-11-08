<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class StudentController extends Controller
{

    public function index(Request $request)
    {
        return $request->user()->coursesEnrolled()->with('teacher')->get();
    }

    public function store(Request $request, Cour $cour)
    {
        try {
            Gate::authorize('enrol',  $cour);

            // $request->user()->coursesEnrolled()->syncWithoutDetaching([$cour->id]);
            $user = $request->user();

            $user->coursesEnrolled()->attach($cour->id);

            return  [
                'message' => "Inscription réussie au cours",
                'user' => $user,
                'cour' => $cour
            ];
        } catch (Exception $e) {
            return $e;
        }
    }
}
