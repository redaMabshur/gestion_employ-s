<?php

namespace App\Http\Controllers;
use App\Models\Employer;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployerRequest;

class EmployerController extends Controller
{
    public function index(){
        $employers =Employer::with('departement')->paginate(10);
        return view('employers.index',compact('employers'));
    }


    public function create(){
        $departements = Departement::All();
        
        return view('employers.create',compact('departements'));
    }


    public function edit(Employer $employer){
        $departements = Departement::All();
        return view('employers.edit',compact('employer','departements'));
    }




    public function store(StoreEmployeRequest $request){
        try {
            //code...
            $query = Employer::create($request->all());
            if($query){
                return  redirect()->route('employers.index')->with('success_message','Employe ajouté');
            }
        } catch (Exception $e) {
            dd($e);
        }

        
    }


    public function update(UpdateEmployerRequest $request,Employer $employer){
        try {
            //code...
            $employer->nom = $request->nom;
            $employer->prenom = $request->prenom;
            $employer->email = $request->email;
            $employer->conatct = $request->conatct;
            $employer->departement_id = $request->departement_id;
            $employer->monatnt_journalier = $request->monatnt_journalier;

            $employer->update();   

            return redirect()->route('employers.index')->with('success_message','Mise à jour effectuée avec succès');

        } catch (Exception $e) {
            //throw $th;
            dd($e);
        }
    }
    public function delete(Employer $employer){
        try {
            //code...
            $employer->delete();
            return  redirect()->route('employers.index')->with('success_message','Emploiye supprimé');
        } catch (Exception $e) {
            //throw $th;
            dd($e);
        }
    }

}
