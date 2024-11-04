<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Employer;
use App\Models\Payment;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use PDF;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $defaultPaymentDateQuery = Configuration::where('type','PAYMENT_DATE')->first();
        $defaultPaymentDate = $defaultPaymentDateQuery->value;
        $convertedPaymentDate =intval($defaultPaymentDate);
        $today = date('d');
        $isPaymentDay = false; 
        if ($today == $convertedPaymentDate){
            $isPaymentDay = true ;
        }
        $payments = Payment::latest()->orderBy('id','desc')->paginate(10);
        return view('paiements.index' , compact( 'payments','isPaymentDay'));
    }
    public function initPayment(){
        $monthMapping = ['JANUARY' => "JANVIER",'FEBRUARY' => "FEVRIER",'MARCH' => "MARS",'APRIL' =>"AVRIL",'MAY' => "MAI",'JUNE' => "JUIN",'JULY' => "JUILLET",'AUGUST' => "AOUT",'SEPTEMBER' => "SEPTEMBRE",'OCTOBER' => "OCTOBRE",'NOVEMBER' => "NOVEMBRE",'DECEMBER' => "DECEMBRE",];
        $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));

        // mois en cours
        $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';

        //annee en cours
        $currentYear = Carbon::now()->format('Y');



        //recuperer la liste des employé n'ayant pas encore payé pour le mois en cour
        $employers = Employer::whereDoesntHave('payments', function($query) use($currentMonthInFrench, $currentYear) {
            $query->where('month' , '=',$currentMonthInFrench)
            ->where('year','=' , $currentYear);
        })->get();
        if($employers->count() == 0){
            return redirect()->back()->with('error_message','tous les employés ont été payés pour ce mois '. $currentMonthInFrench );
        }
        foreach($employers as $employer)(
            $aEtepayer = $employer->Payments()->where('month', '=',$currentMonthInFrench)->where('year','=',$currentYear)->exists()
        );
        if(!$aEtepayer){
            $salaire = $employer->montant_journalier * 30;
            $payment = new Payment([
                'reference' => strtoupper(Str::random(10)),
                'employer_id' =>$employer->id,
                'amount'=> $salaire,
                'launch_date' => now(),
                'done_time' => now(),
                'status'=> 'SUCCESS',
                'month' => $currentMonthInFrench,
                'year' => $currentYear
            ]);
            $payment->save();

        }
        return redirect()->back()->with('status_message','Paiement des employés effectuer pour le mois de ' . $currentMonthInFrench);
    }
    public function Download_invoice(Payment $payment){
        try {
            //code...
            $fullPaymentInfo = Payment::with('employer')->find($payment->id);
            //return  view('paiements.facture',compact('fullPaymentInfo'));
            $pdf = PDF::loadView('paiements.facture',compact('fullPaymentInfo')) ;
            return $pdf->download('facture_' . $fullPaymentInfo->employer->nom.'.pdf' );
        } catch (Exception $e) {
            throw new Exception( "Erreur de génération du PDF");
            //throw $th;
        }
    }
    
}
