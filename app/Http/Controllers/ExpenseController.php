<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Exception;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'bill_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       try {
       

        $billImagePath = null;
        if ($request->hasFile('bill_image')) {
            $billImagePath = $request->file('bill_image')->move('images/bills/', time().'_'.$request->file('bill_image')->getClientOriginalName());
        }

        Expense::create([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'bill_image' => $billImagePath,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
       } catch (Exception $th) {
        return back()->withInput()->with('error', $th->getMessage());
       }
    }

    public function destroy(Expense $expense)
    {
        if ($expense->bill_image && file_exists(public_path($expense->bill_image))) {
            unlink(public_path($expense->bill_image));
        }
    
        $expense->delete();
    
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
    
}
