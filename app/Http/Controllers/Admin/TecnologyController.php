<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TecnologyRequest;
use App\Models\Tecnology;
use Illuminate\Http\Request;

class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
*/
    public function index()
    {
        $tecnology = Tecnology::orderByDesc('id')->paginate(10);
        return view('admin.tecnologies.index', compact('tecnology'));
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
    public function store(TecnologyRequest $request)
    {
        $form_data = $request->all();

        $exist = Tecnology::where('name', $form_data['name'])->first();
        if($exist){
            return redirect()->route('admin.tecnologies.index')->with('error', 'Tipo già esistente');
        }else{
            $new_tecnology = new Tecnology();
            $form_data['slug'] = Helper::createSlug($form_data['name'], Tecnology::class);
            $new_tecnology->fill($form_data);
            $new_tecnology->save();

            return redirect()->route('admin.tecnologies.index')->with('success', 'Il Tipo è stato creato');

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
    public function update(TecnologyRequest $request, Tecnology $tecnology)
    {
        $form_data = $request->all();

        if($form_data['name'] === $tecnology->name){
            $form_data['slug'] = $tecnology->slug;
        }else{
            $form_data['slug'] = Helper::createSlug($form_data['name'], Tecnology::class) ;
        }
        $tecnology->update($form_data);
            return redirect()->route('admin.tecnologies.index', $tecnology)->with('update', 'La tecnologia è stata aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();

        return redirect()->route('admin.tecnologies.index')->with('deleted', 'Il progetto'. ' ' . $tecnology->name. ' ' .'è stato cancellato con successo!');
    }
}
