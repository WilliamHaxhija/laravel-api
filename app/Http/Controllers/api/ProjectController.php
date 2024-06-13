<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('type', 'technologies')->paginate(3);
        
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug) {
        $project = Project::where('slug', '=', $slug )->with('type', 'technologies')->first();

        if ($project) {
            $data = [
                'success' => true,
                'project' => $project
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'No project matching current slug'
            ];
        }
        return response()->json($data);
    }
}
