<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->paginate(10);
        return view('admin.types.index', compact('types'));
    }

    public function typeProjects(){
        $types = Type::paginate(5);
        return view('admin.types.type-projects', compact('types'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $form_data = $request->all();

        $exist = Type::where('name', $form_data['name'])->first();
        if($exist){
            return redirect()->route('admin.types.index')->with('error', 'Tipo già esistente');
        }else{
            $new_type = new Type();
            $form_data['slug'] = Helper::createSlug($form_data['name'], Type::class);
            $new_type->fill($form_data);
            $new_type->save();

            return redirect()->route('admin.types.index')->with('success', 'Il Tipo è stato creato');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $form_data = $request->all();


        $exist = Type::where('name', $form_data['name'])->first();
        if($form_data['name'] === $type->name){
            $form_data['slug'] = $type->slug;
        }else{
            $form_data['slug'] = Helper::createSlug($form_data['name'], Type::class) ;
        }

        $type->update($form_data);

        return redirect()->route('admin.types.index',$type)->with('update', 'Il tipo è stato aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('deleted', 'Il progetto'. ' ' . $type->name. ' ' .'è stato cancellato con successo!');
    }
}
