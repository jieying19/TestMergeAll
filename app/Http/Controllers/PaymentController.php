<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class PaymentController extends Controller
{
    //Below are payment functions for admin
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check whether user login or not, if not redirect to login
        if (!auth()->user()) {
            // Redirect to login page
            return redirect()->route('login');
        }

        Payment::where('amountPayed', '=', 0)->update(['paymentStatus' => 'Not Payed']);
        Payment::where('amountPayed', '>', 0)->whereColumn('amountPayed', '<', 'amountOwed')->update(['paymentStatus' => 'Partially Payed']);
        Payment::whereColumn('amountPayed', '>', 'amountOwed')->update(['paymentStatus' => 'Fully Payed']);

        $payments = Payment::all();
        
        return view('payment.index', ['payments' => $payments]);
    }

    public function create(){
        return view('payment.create');
    }

    public function insert(Request $request){
        $payment = new Payment;
        Payment::orderBy('id')->get();
        $payment->userName = $request->name;
        $payment->amountOwed = $request->owed;
        $payment->amountPayed = $request->payed;
        $payment->paymentMethod = $request->methodpay;
        $payment->lastPayment = $request->lastpay;

        $payment->cardNumber = null;
        $payment->bankName = null;
        $payment->cardCVV = null;
        $payment->cardExpDate = null;
        $payment->cardHolderName = null;

        $payment->save();
        return redirect()->route('payment.index')->with('success', 'New payment added successfully');
    }

    public function edit($id)
    {
        $paymentDetails = Payment::find($id);
        //dd($paymentDetails);
        return view('payment.edit', compact('paymentDetails'));
    }

    public function update(Payment $payment, Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->userName = $request->name;
        $payment->amountOwed = $request->owed;
        $payment->amountPayed = $request->payed;
        $payment->paymentMethod = $request->methodpay;
        $payment->lastPayment = $request->lastpay;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'User payment updated successfully');
    }

    public function delete($id){
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payment.index')->with('success', 'Product deleted successfully');
    }


    //Below are controller functions for user/cashier
    public function userIndex(){
        if (!auth()->user()) {
            // Redirect to login page
            return redirect()->route('login');
        }

        $payments = Payment::all();

        return view('payment.userIndex', ['payments' => $payments], compact('payments'));
    }

    public function updateUser(Payment $payment, Request $request)
    {
        $payment = Payment::where('userName', '=', $request->userName)->first();
        $payment->cardNumber = $request->input('cardNum');
        $payment->bankName = $request->category;
        $payment->cardCVV = $request->cvv;
        $payment->amountPayed += $request->amountPay;
        $payment->cardExpDate = $request->expiration;
        $payment->cardHolderName = $request->holderName;
        $payment->lastPayment = Carbon::now();
        $payment->save();

        return redirect()->route('payment.userIndex')->with('success', 'Your payment updated successfully');
    }
}
