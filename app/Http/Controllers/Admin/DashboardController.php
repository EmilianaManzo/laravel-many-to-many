<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $projects = Project::orderByDesc('id')->paginate(8);
        $tecns = Tecnology::all();
        $types = Type::all();
        return view('admin.home', compact('projects','tecns','types'));
    }
}
