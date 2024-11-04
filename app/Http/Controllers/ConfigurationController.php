<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigRequest;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function index(){
        $allConfigurations = Configuration::latest()->paginate(10);
        return view('config.index',compact('allConfigurations'));
    }
    public function create(){
        return view('config.create');
    }
    public function store(storeConfigRequest $request){
        try {
            //code...
            Configuration::create($request->all());
            return redirect()->route('configurations')->with('success_message','Configuration Ajouté');
        } catch (Exception $e) {
            //throw $th;
            dd($e);
            throw new Exception("erreur lors de l'enregistrement de la configuration");
        };
    }
    public function delete(Configuration $configuration){
        try {
            //code...
            $configuration->delete();
            return  redirect()->route('configurations')->with('success _message', 'Configuration retirée avec succé');
        } catch (Exception $e) {
            //throw $th;
            throw new Exception("Erreur lors de la suppression de configuration");
            
        };
    }
}
