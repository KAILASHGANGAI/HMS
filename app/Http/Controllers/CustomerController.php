<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\CustomerImage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::select('id', 'name', 'phone', 'address', 'status', 'follow_up_date');
            return  $this->getdata($customers);
        }
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $users = User::all();
        return view('customers.create', compact('users'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        # dd($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'status' => 'nullable|string',
                'problem' => 'nullable|string',
                'follow_up_date' => 'nullable|date',
                'user_id' => 'required|integer',
                'note' => 'nullable|string',
                'longitude' => 'nullable|string',
                'latitude' => 'nullable|string',
                'budget' => 'nullable|string',
            ]);
            Customer::create($request->all());

            return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        } catch (Exception $th) {
            dd($th);
        }
    }

    // Display the specified resource
    public function show(Customer $customer)
    {
        $customer = Customer::with(['images', 'user'])->find($customer->id);
        return view('customers.show', compact('customer'));
    }

    // Show the form for editing the specified resource
    public function edit(Customer $customer)
    {
        $users = User::all();
        return view('customers.edit', compact('customer', 'users'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Customer $customer)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'status' => 'nullable',
                'problem' => 'nullable|string',
                'follow_up_date' => 'nullable|date',
                'user_id' => 'required|integer',
                'note' => 'nullable|string',
                'longitude' => 'nullable|string',
                'latitude' => 'nullable|string',
            ]);

            $customer->update($request->all());

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
        } catch (Exception $th) {
            dd($th);
        }
    }

    // Remove the specified resource from storage
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function sideUpdate($id)
    {
        $customer = Customer::find($id);

        return view('customers.sideupdate', compact('customer'));
    }
    public function expenses($id)
    {
        $customer = Customer::find($id);

        return view('customers.expenses', compact('customer'));
    }
    public function cupdate(Request $request, $id)
    {
        $data = $request->all();
        $customer = Customer::find($id);

        unset($data['images']);

        $customer->update($data);

        //update Images 
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imagePath = $image->move('images/customers/siteimage/', time() . '_' . $image->getClientOriginalName());
                CustomerImage::create([
                    'customer_id' => $customer->id,
                    'image' => $imagePath,
                ]);
            }
        }
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Customer updated successfully.']);
        }
        return back()->with('success', 'Customer updated successfully.');
    }

    public function getdata($customer)
    {
        $customers = Customer::all();
        return DataTables::of($customers)
            ->editColumn('phone', function ($customer) {
                return '<a href="tel:' . $customer->phone . '">' . $customer->phone . '</a>';
            })
            ->addColumn('action', function ($customer) {
                $viewBtn = '<a href="' . route('customers.show', $customer->id) . '" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>';

                if (auth()->user()->is_admin) {
                    //edit and delete only 
                    $update = route('customers.edit', $customer->id);
                    $editButton = '<a href="' . $update . '" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';

                    $delete = '<form action="' . route('customers.destroy', $customer->id) . '" method="POST" style="display:inline;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>';
                    $cexp = route('customers.expenses', $customer->id);
                    $expenseButton = '<a href="' . $cexp . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-money-bill-trend-up"></i> </a>';

                    return $viewBtn . ' ' . $editButton . ' ' . $delete. ' ' . $expenseButton;
                } else {

                    $editButton = '<a href="' . route('customers.sideupdate', $customer->id) . '"  class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';

                    $locationButton = '';
                    if (is_null($customer->longitude) && is_null($customer->latitude)) {
                        $locationButton = '<button onclick="getLocation(' . $customer->id . ')" class="btn btn-primary btn-sm getLocationBtn" data-customer-id="' . $customer->id . '">
                    <i class="fa-solid fa-location-pin"></i></button>';
                    }else{
                        $locationButton = '<button onclick="showLocation(' . $customer->latitude . ',' . $customer->longitude . ')" class="btn btn-secondary btn-sm getLocationBtn" data-customer-id="' . $customer->id . '">
                    GO</button>';
                        
                    }
                    $cexp = route('customers.expenses', $customer->id);
                    $expenseButton = '<a href="' . $cexp . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-money-bill-trend-up"></i> </a>';

                    return $viewBtn . ' ' . $editButton . ' ' .  $expenseButton. ' ' . $locationButton;
                }
            })
            ->rawColumns(['phone', 'action']) // Ensure HTML is rendered
            ->make(true);
    }
}
