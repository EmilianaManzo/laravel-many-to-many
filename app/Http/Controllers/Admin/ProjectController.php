<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET['toSearch'])){
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(15);
            $count_search = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->count();
        }else{

            $projects = Project::orderBy('id')->paginate(15);
            $count_search = Project::count();
        }

        $direction = 'desc';

        return view('admin.projects.index', compact('projects','count_search','direction'));
    }

    public function orderBy($direction , $column){
        $direction =  $direction === 'desc' ? 'asc' : 'desc' ;
        $projects = Project::orderBy($column, $direction)->paginate(15);
        $count_search = Project::count();
        return view('admin.projects.index', compact('projects','count_search','direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title='Crea un nuovo progetto';
        $route=route('admin.projects.store');
        $project=null;
        $button='Crea progetto';
        $method= 'POST';
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','route','project', 'button','method','types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        // verifico l'esistenza della chiave 'image' in $form_data
        if(array_key_exists('image', $form_data)){
            // salvo l'immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $form_data['image']);

            // ottengo il nome originale dell'immagine
            $original_name = $request->file('image')->getClientOriginalName();
            $form_data['image']= $image_path;
            $form_data['image_original_name']= $original_name;

        }


        $exist = Project::where('title', $form_data['title'])->first();
        if($exist){
            return redirect()->route('admin.projects.create')->with('error', 'Progetto già esistente');
        }else{
            $new_project = new Project();
            $form_data['slug'] = Helper::createSlug($form_data['title'], Project::class);

        }
        $new_project->fill($form_data);

        $new_project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Il progetto è stato creato');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Project $project)
    {

        $title='Modifica progetto';
        $route=route('admin.projects.update', $project);
        $button='Aggiorna progetto';
        $method= 'PUT';
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','route','project', 'button','method','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();


        // $exist = Project::where('title', $form_data['title'])->first();

        // if($exist){
        //     return redirect()->route('admin.projects.index')->with('errorexist', 'Progetto già esistente');
        // }else{

             // verifico l'esistenza della chiave 'image' in $form_data
            if(array_key_exists('image', $form_data)){
                // salvo l'immagine nello storage e ottengo il percorso
                $image_path = Storage::put('uploads', $form_data['image']);

                // ottengo il nome originale dell'immagine
                $original_name = $request->file('image')->getClientOriginalName();
                $form_data['image']= $image_path;
                $form_data['image_original_name']= $original_name;

            }

            if($form_data['title'] === $project->title){
            $form_data['slug'] = $project->slug;
            }else{
                $form_data['slug'] = Helper::createSlug($form_data['title'], Project::class) ;
            }

            $project->update($form_data);
            return redirect()->route('admin.projects.index',$project)->with('update', 'Il progetto è stato aggiornato');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Il progetto'. ' ' . $project->title. ' ' .'è stato cancellato con successo!');
    }
}
