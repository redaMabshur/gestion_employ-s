<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index(){
        $departements = Departement::paginate(10);
        return view('departements.index',compact('departements'));
    }


    public function create(){
        return view('departements.create');
    }


    public function edit(Departement $departement){
        return view('departements.edit',compact('departement'));
    }





    //interraction avec la BD
    public function store(Departement $departement,saveDepartementRequest $request){
        //enregistrer un nouveau département
        try {
            //code...

            $departement->name = $request->name;
    
            $departement->save();

            return redirect()->route('departement.index')->with('success_message','Département enregistré');
            
        } catch (Exception $e) {
            //throw $th;
            dd($e);
        }
    }    public function update(Departement $departement,saveDepartementRequest $request){
        //enregistrer un nouveau département
        try {
            //code...
            $departement->name = $request->name;
    
            $departement->update();

            return redirect()->route('departement.index')->with('success_message','Département mis à jour');
            
        } catch (Exception $e) {
            //throw $th;
            dd($e);
        }
    }    
        public function delete(Departement $departement){
        //enregistrer un nouveau département
        try {
            //code...    
            $departement->delete();

            return redirect()->route('departement.index')->with('success_message','Département supprimé');
            
        } catch (Exception $e) {
            //throw $th;
            dd($e);
        }
    }
}
