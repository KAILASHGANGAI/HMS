<?php

namespace App\Http\Controllers;

use App\Models\Deposite;
use App\Http\Requests\StoreDepositeRequest;
use App\Http\Requests\UpdateDepositeRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepositeController extends Controller
{
    public function index(Request $request)
    {
        $deposits = Deposite::with('customer')->get();
        $customers = Customer::all(); // Needed for the form
        if ($request->ajax()) {
            return DataTables::of($deposits)
                ->editColumn('customer', function ($deposits) {
                    return $deposits->customer->name;
                })
                ->editColumn('receipt', function ($deposits) {
                    return '
                    <a href="' . asset($deposits->receipt) . '" target="_blank">
                      <img src="' . asset($deposits->receipt) . '" alt="Receipt" style="width: 60px; height: 40px">

                    </a>
                    ';
                })

                ->addColumn('action', function ($deposits) {
                    // edit and delete buttons
                    return $this->getEdit($deposits);
                })
                ->addIndexColumn()
                ->rawColumns(['receipt', 'action'])
                ->make(true);
        }
        return view('deposits.index', compact('deposits', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('deposits.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
        ]);
        $receiptPath = '';
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            // Move the image to the public directory
            $receiptPath = $request->file('image')
                ->move('images/deposits/', $filename);
        }

        $datas['receipt'] = $receiptPath;
        Deposite::create($datas);
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
        #dd($request->all());
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
            'note'=> 'nullable|string',
        ]);
        $receiptPath = '';
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            // Move the image to the public directory
            $receiptPath = $request->file('image')
                ->move('images/deposits/', $filename);
            if (file_exists($deposit->receipt)) {
                unlink($deposit->receipt);
            }
            $data['receipt'] = $receiptPath;
        }
        $deposit->update($data);
        return redirect()->route('deposits.index')->with('success', 'Deposite updated successfully.');
    }

    public function destroy(Deposite $deposit)
    {
        $deposit->delete();
        return redirect()->route('deposits.index');
    }

    public function getEdit($deposits)
    {

        $edit = $this->edithtml($deposits);;
        $deleteUrl = route('deposits.destroy', $deposits);
        $delete = '<form action="' . $deleteUrl . '" method="POST" class="d-inline">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>';
        return $edit . ' ' . $delete;
    }

    public function edithtml($deposit)
    {
        $customers = Customer::all();
        $update = route('deposits.update', $deposit);
        return '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDepositModal-' . $deposit->id . '">
                        Edit
                    </button>

            <div class="modal fade" id="editDepositModal-' . $deposit->id . '" tabindex="-1" role="dialog" aria-labelledby="editDepositModalLabel-' . $deposit->id . '" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDepositModalLabel-' . $deposit->id . '">Edit Deposit for ' . $deposit->customer->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="' . $update . '" method="POST" enctype="multipart/form-data">
                          
                             <input type="hidden" name="_method" value="PUT">
                             <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="customer_id" class="form-control" value="' . $deposit->customer_id . '" required/>
                                
                                    
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" step="0.01" value="' . $deposit->amount . '" required>
                                </div>
                                <div class="form-group">
                                    <label for="deposit_date">Deposit Date</label>
                                    <input type="date" name="deposit_date" class="form-control" value="' . $deposit->deposit_date . '" required>
                                </div>
                                <div class="form-group">
                                    <label for="receipt">Receipt </label>
                                    <input type="file" name="image" class="form-control" value="' . $deposit->receipt . '">
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="">' . $deposit->note . '</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        ';
    }
}
