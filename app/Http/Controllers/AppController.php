<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employer;
use App\Models\User;
use Carbon\Carbon ;
use App\Models\Configuration;
use Illuminate\Http\Request;


class AppController extends Controller
{
    public function  index(){
        $totalDepartements = Departement::all()->count();
        $totalEmployers =  Employer::all()->count();
        $totalAdministrateurs =  User::all()->count();


        $defaultPaymentDate = null ; 
        $paymentNotification = "";
        $currentDate = Carbon::now()->day ;
        //$appName = Configuration::where('type','APP_NAME')->first();
        $defaultPaymentDateQuery = Configuration::where('type','PAYMENT_DATE')->first();
        if($defaultPaymentDateQuery){
            $defaultPaymentDate = $defaultPaymentDateQuery->value;
            $convertedPaymentDate =intval($defaultPaymentDate);
            if($currentDate < $convertedPaymentDate){
                $paymentNotification ='le paiement doit avoir le ' .$defaultPaymentDate . ' de ce mois ' ;
            }else{
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format('F');
                $paymentNotification = 'la paiement doit avoir le '.$defaultPaymentDate .' du mois de ' .$nextMonthName;
            }
        }

        return view('dashboard',compact("totalDepartements","totalEmployers","totalAdministrateurs","paymentNotification"));
    }

}
