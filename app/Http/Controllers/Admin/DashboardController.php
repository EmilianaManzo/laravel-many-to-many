<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $projects = Project::where('user_id', Auth::id())->orderByDesc('id')->paginate(8);
        $tecns = Tecnology::all();
        $types = Type::all();
        return view('admin.home', compact('projects','tecns','types'));
    }
}
