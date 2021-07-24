<?php

namespace App\Http\Controllers;

use App\Models\Park;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use tidy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $parks = Park::all();

        return view('main.home', compact('parks'));
    }


    public function create_reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time_a' => '',
            'time_d' => '',
            'model' => 'string',
            'plate_num' => 'string',
            'park' => "required",
            'space' => "required",
        ]);
        // dd($request->space[$request->park]);
        if ($validator->fails()) {
            return redirect('/home')->withErrors($validator);
        }

        $start = explode('T', $request->time_a);
        $startTime = $start['0'] . ' ' . $start[1] . ':00';

        $end = explode('T', $request->time_d);
        $endTime = $end['0'] . ' ' . $end[1] . ':00';

        if ($request->space[$request->park] != null) {
            $trans = Transaction::create([
                'user_id' => Auth::user()->id,
                'space_id' => $request->space[$request->park],
                'model' => $request->model,
                'plate_num' => $request->plate_num,
                'time_A' => $startTime,
                'time_D' => $endTime,
            ]);

            Transaction::where("id", "=", $trans->id)->update([
                'user_id' => Auth::user()->id,
                'space_id' => $request->space[$request->park],
                'time_D' => $endTime,
                "payment_status" => 0,
            ]);

            if ($trans) {
                return redirect()->route('show_pay', ['id' => $trans->id])->with('success', 'pay now');
            } else {
                return redirect("/home")->with('errors', 'Not Added to transaction');
            }
        } else {
            return redirect()->route('home')->with('error', 'Please make sure Add a valid Parking Space');
        }
    }


    public function show_pay($id)
    {
        $transaction = Transaction::find($id);

        return view("main.pay", compact('transaction'));
        // dd($transaction);
    }


    public function review()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->get();

        return view('main.review', compact('transactions'));
    }
}
