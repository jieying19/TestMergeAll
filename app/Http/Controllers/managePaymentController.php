<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\managePaymentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class managePaymentController extends Controller
{
    //Below are payment functions for admin
    /**
     * Display a listing of the resource.
     */

    // Below are functions for Kafa Admin and MUIP admin
    public function receiptList()
    {
        // Check whether user login or not, if not redirect to login
        if (!auth()->user()) {
            // Redirect to login page
            return redirect()->route('login');
        }

        managePaymentModel::where('payment_made', '=', 0)->update(['payment_status' => 'Not Payed']);
        managePaymentModel::where('payment_made', '>', 0)->whereColumn('payment_made', '<', 'payment_owed')->update(['payment_status' => 'Partially Payed']);
        managePaymentModel::whereColumn('payment_made', '>=', 'payment_owed')->update(['payment_status' => 'Fully Payed']);

        $payments = managePaymentModel::all();
        
        return view('ManagePayment.staffView.viewReceiptListPage', ['payments' => $payments]);
    }

    // Direct the admin to edit the payment data
    public function edit($id)
    {
        $paymentDetails = managePaymentModel::find($id);
        return view('ManagePayment.staffView.editReceiptPage', compact('paymentDetails'));
    }

    // Store the payment data into the database
    public function update(managePaymentModel $payment, Request $request)
    {
        $payment = managePaymentModel::find($request->id);
        $payment->cardBank = $request->cardBank;
        $payment->cardNum = $request->cardNum;
        $payment->cardCVV = $request->CVV;
        $payment->cardExpirationDate = $request->expiration;
        $payment->cardholderName = $request->holderName;
        $payment->cardholderState = $request->holderState;
        $payment->cardholderCity = $request->holderCity;
        $payment->cardholderPostalCode = $request->holderPostal;
        $payment->eWalletbank = $request->walletBank;
        $payment->eWalletAccNum = $request->walletAcc;
        $payment->parent_id = $request->parentID;
        $payment->payment_method = $request->payMethod;
        $payment->payment_owed = $request->owed;
        $payment->payment_made = $request->payed;
        $payment->payment_date = Carbon::now();
        $payment->save();

        return redirect()->route('viewReceiptListPage')->with('success', 'User`s payment updated successfully');
    }

    //Delete function for staff
    public function delete($id){
        $payment = managePaymentModel::find($id);
        $payment->delete();
        return redirect()->route('viewReceiptListPage')->with('success', 'Payment deleted successfully');
    }

    //Below are controller functions for user/cashier

    // Function for user's to view their payment page
    public function choosePayMethod(){
        if (!auth()->user()) {
            // Redirect to login page
            return redirect()->route('login');
        }

        managePaymentModel::where('payment_made', '=', 0)->update(['payment_status' => 'Not Payed']);
        managePaymentModel::where('payment_made', '>', 0)->whereColumn('payment_made', '<', 'payment_owed')->update(['payment_status' => 'Partially Payed']);
        managePaymentModel::whereColumn('payment_made', '>=', 'payment_owed')->update(['payment_status' => 'Fully Payed']);

        $parent_id = Auth::user()->parent_id;
        $payments = managePaymentModel::where('parent_id', $parent_id)->get();

        return view('ManagePayment.userView.choosePayMethodPage', compact('payments'));
    }

    // Function to redirect parent to card form
    public function cardMethodcreate()
    {
        return view('ManagePayment.userView.DebitCreditCardFormPage');
    }

    // Function to redirect parent to e-wallet form
    public function walletMethodcreate()
    {
        return view('ManagePayment.userView.EWalletFormPage');
    }

    // Function for system to insert card payment into database
    public function cardMethodinsert(Request $request)
    {
        $payment = new managePaymentModel;
        managePaymentModel::orderBy('parent_id')->get();

        $payment->cardBank = $request->cardBank;
        $payment->cardNum = $request->cardNum;
        $payment->cardCVV = $request->CVV;
        $payment->cardExpirationDate = $request->expiration;
        $payment->cardholderName = $request->holderName;
        $payment->cardholderState = $request->holderState;
        $payment->cardholderCity = $request->holderCity;
        $payment->cardholderPostalCode = $request->holderPostal;
        $payment->eWalletbank = null;
        $payment->eWalletAccNum = null;
        $payment->parent_id = $request->parentID;
        $payment->payment_method = "Card";
        $payment->payment_owed = 500;
        $payment->payment_made = $request->payed;
        $payment->payment_date = Carbon::now();
        $payment->save();

        return redirect()->route('choosePayMethodPage')->with('success', 'Your payment via card updated successfully');
    }

    // Function for system to insert wallet payment into database
    public function walletMethodinsert(managePaymentModel $payment, Request $request)
    {
        $payment = new managePaymentModel;
        managePaymentModel::orderBy('parent_id')->get();

        $payment->cardBank = null;
        $payment->cardNum = null;
        $payment->cardCVV = null;
        $payment->cardExpirationDate = null;
        $payment->cardholderName = null;
        $payment->cardholderState = null;
        $payment->cardholderCity = null;
        $payment->cardholderPostalCode = null;
        $payment->eWalletbank = $request->walletBank;
        $payment->eWalletAccNum = $request->walletAcc;
        $payment->parent_id = $request->parentID;
        $payment->payment_method = "Wallet";
        $payment->payment_owed = 500;
        $payment->payment_made = $request->payed;
        $payment->payment_date = Carbon::now();
        $payment->save();

        return redirect()->route('choosePayMethodPage')->with('success', 'Your payment via wallet updated successfully');
    }
}
