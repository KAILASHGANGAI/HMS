<?php

namespace App\Http\Controllers;

use App\Models\CustomerExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerExpenseController extends Controller
{
    public function index()
    {
        $CustomerExpenses = CustomerExpense::all();
        return view('customers.expenses', compact('CustomerExpenses'));
    }

    public function create()
    {
        return view('customers.expenses');
    }

    public function store(Request $request)
    {
        #dd($request->all());
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric',
            'bill_image' => 'nullable|image|max:2048',
        ]);
        $validatedData['user_id'] = Auth::user()->id;

        if ($request->hasFile('bill_image')) {
            // move to public 
            $billImagePath = $request->file('bill_image')
                ->move('images/customers/expenses/', time() . '_' . $request->file('bill_image')
                ->getClientOriginalName());
            $validatedData['bill_image'] = $billImagePath;
        }

        CustomerExpense::create($validatedData);
        return back()->with('success', 'CustomerExpense added successfully.');
    }

    public function show(CustomerExpense $CustomerExpense)
    {
        return view('CustomerExpenses.show', compact('CustomerExpense'));
    }

    public function edit(CustomerExpense $CustomerExpense)
    {
        return view('CustomerExpenses.edit', compact('CustomerExpense'));
    }

    public function update(Request $request, CustomerExpense $CustomerExpense)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric',
            'CustomerExpense_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('CustomerExpense_image')) {
            // Delete the old image
            if ($CustomerExpense->CustomerExpense_image) {
                Storage::disk('public')->delete($CustomerExpense->CustomerExpense_image);
            }
            $validatedData['CustomerExpense_image'] = $request->file('CustomerExpense_image')->store('CustomerExpense_images', 'public');
        }

        $CustomerExpense->update($validatedData);

        return redirect()->route('CustomerExpenses.index')->with('success', 'CustomerExpense updated successfully.');
    }

    public function destroy(CustomerExpense $CustomerExpense)
    {
        if ($CustomerExpense->CustomerExpense_image) {
            Storage::disk('public')->delete($CustomerExpense->CustomerExpense_image);
        }

        $CustomerExpense->delete();

        return redirect()->route('CustomerExpenses.index')->with('success', 'CustomerExpense deleted successfully.');
    }
}
