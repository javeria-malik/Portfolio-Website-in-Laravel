<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Education; // Import the Education model
use App\Models\Experience; // Import the Experience model
use App\Models\Service;
use App\Models\Skill;
use App\Models\Project;

class HomeController extends Controller
{
    public function homepage()
    {
        // Fetch education data from the database without sorting
        $educations = Education::active()->get();


        // Fetch experience data from the database without sorting
        $experiences = Experience::active()->get();
        //fetch all services data
        $services = Service::active()->get();

        $skills = Skill::active()->get();
        $projects = Project::active()->get();;

        // Pass both education and experience data to the view
        return view('home.homepage', compact('educations', 'experiences','services','skills','projects'));
    }
}
