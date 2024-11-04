<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\updateAdminRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Auth;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


use function PHPUnit\Framework\throwException;

class AdminController extends Controller
{
    public function index(){
        $admins = User::paginate(10);
        return view('admin.index',compact('admins'));
    }

    public function create(){
        return view('admin.create');
    }


    public function edit(User $user){
        return view('admin.edit',compact('user'));
    }


    public function store(StoreAdminRequest $request){
        try {
            //code...
            //logique de creation de compte
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');

            $user->save();

            //Envoyer un mail pour que l'utilisateur puisse confirmer son compte
            
            //Envoyer un code par email pour verification
            if($user){
                try {
                    //code...
                    ResetCodePassword::where('email', $user->email)->delete();
                    $code = rand(1000,4000);
                    $data = [
                        'code' => $code,
                        'email' =>$user->email
                    ];
                    ResetCodePassword::create($data);
                    Notification::route('mail',$user->email)->notify(new 
                    SendEmailToAdminAfterRegistrationNotification($code,$user->email));
                    //rediriger vers un URL
                    return redirect()->route('administrateurs')->with('success_message','Administrateurs ajouté avec succé');
                } catch (Exception $e) {
                    //throw $th;
                    throw new Exception('une erreur est servenue lors du l\'envoie du mail');
                }

            }
        } catch (Exception $e) {
            //throw $th;
            dd($e);
            //throw new Exception('une erreur servenue lors de la creation
             //de cet administrateur');
        }
    }


    public function update(updateAdminRequest $request,User $user){
        try {
            //code...
            //logique de mise à jour de compte
        } catch (Exception $e) {
            //throw $th;
            //dd($e);
            throw new Exception('une erreur servenue lors de la mise à jour des
            informations de l\'utilisateur');
        }
    }

    public function delete(User $user){
        try {
            //code...
            //logique de suppression
            //l'admin connecté ne puisse pas supprimé son compte
            $connectedAdminId = Auth::user()->id ;
            
            if($connectedAdminId !==  $user->id ){
                $user->delete();

                return redirect()->back()->with('success_message', "l'administrateur a été supprimé");
            }else{
                return redirect()->back()->with('error_message', "Vous ne pouvez pas supprimé votre compte administrateur");

            }
            
        } catch (Exception $e) {
            //throw $th;
            //dd($e);
            throw new Exception('une erreur servenue lors de la suppression du
            compte de l\'admin');
        }
    }


    public function defineAccess($email){

        $checkUserExist = User::where('email',$email)->first();
    
        if($checkUserExist){
            return view('auth.validate-account',compact('email'));
        }else{
            //return redirect()->route('login');
        }
    }
    public function submitDefineAccess(submitDefineAccessRequest $request){
        try {
            $user = user::where('email',$request->email)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();
                return redirect()->route('login')->with('success_message','Vos accès ont été correctement définis');


                if($user){
                    $existingCode = ResetCodePassword::where('email',$user->email)->count();
                    if  ($existingCode > 1 ) {
                        ResetCodePassword::where('email',$user->email)->delete();
                    }
                }
            }else{
                //404
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
