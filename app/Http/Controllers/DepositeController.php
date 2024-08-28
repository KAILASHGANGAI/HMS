<?php

namespace App\Http\Controllers;

use App\Models\Deposite;
use App\Http\Requests\StoreDepositeRequest;
use App\Http\Requests\UpdateDepositeRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class DepositeController extends Controller
{ public function index()
    {
        $deposits = Deposite::with('customer')->get();
        $customers = Customer::all(); // Needed for the form
        return view('deposits.index', compact('deposits', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('deposits.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
        ]);

        Deposite::create($request->all());
        return redirect()->route('deposits.index');
    }

    public function show(Deposite $deposit)
    {
        return view('deposits.show', compact('deposit'));
    }

    public function edit(Deposite $deposit)
    {
        $customers = Customer::all();
        return view('deposits.edit', compact('deposit', 'customers'));
    }

    public function update(Request $request, Deposite $deposit)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
        ]);

        $deposit->update($request->all());
        return redirect()->route('deposits.index');
    }

    public function destroy(Deposite $deposit)
    {
        $deposit->delete();
        return redirect()->route('deposits.index');
    }
}
