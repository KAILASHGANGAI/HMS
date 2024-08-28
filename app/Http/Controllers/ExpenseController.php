<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = Expense::all();

        if ($request->ajax()) {

            return DataTables()->of($expenses)
                ->editColumn('bill_Image', function ($row) {
                    return '<a href="' . asset($row->bill_Image) . '" target="_blank">
                      <img src="' . asset($row->bill_Image) . '" alt="Bill Image" style="width: 60px; height: 40px">
                    </a>';
                })
                
                ->addColumn('action', function ($row) {

                    return $this->getEdit($row);
                })
                ->addIndexColumn()
                ->rawColumns(['bill_Image', 'action'])
                ->make(true);
            }
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
    public function getEdit(Expense $expense){
        $delete = route('expenses.destroy', $expense->id);
        return '
          <form action="'.$delete.'" method="POST"
                                style="display:inline;">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
        ';
    }
}
