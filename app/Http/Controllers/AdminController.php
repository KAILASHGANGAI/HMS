<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        if (auth()->user()->is_admin) {
            $customers = Customer::count();
            $expenses = Expense::sum('amount');
            $users = User::count();
            $deposits = 0;
            return view('welcome', compact(
                'customers',
                'expenses',
                'users',
                'deposits'
            ));
        }else{
            
            return view('customers.mycustomers',);
        }
    }
}
