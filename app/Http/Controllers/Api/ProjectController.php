<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies'])->orderBy('id', 'desc')->get();
        $type = Type::all();
        $technologies = Technology::all();
        return response()->json(compact('projects', 'type', 'technologies'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with(['type', 'technologies'])->first();

        if ($project->cover_image) {
            $project->cover_image = url("storage/" . $project->cover_image);
        } else {
            $project->cover_image = url("storage/uploads/placeholder.png");
        }

        return response()->json($project);
    }

    public function search()
    {
        $tosearch = $_POST['tosearch'];
        $projects = Project::where('title', 'like', "%$tosearch%")->with(['type', 'technologies'])->get();
        return response()->json(compact('projects'));
    }

    public function getByType($id)
    {
        $projects = Project::where('type_id', $id)->with(['type', 'technologies'])->get();
        return response()->json($projects);
    }

    public function getByTechnologies($id)
    {
        $list_projects = [];
        $technologies = Technology::where('id', $id)->with(['projects'])->first();
        foreach ($technologies->projects as $project) {
            $list_projects[] = Project::where('id', $project->id)->with(['type', 'technologies'])->first();
        }
        return response()->json($list_projects);
    }
}
