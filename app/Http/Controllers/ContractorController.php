<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Http\Requests\StoreContractorRequest;
use App\Http\Requests\UpdateContractorRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContractorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contractor::all();
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route('contractors.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> ';
                    $btn .= '<form action="' . route('contractors.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . ' ' . method_field('DELETE') . '
                    <button type="submit" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></form>';
                    $view = '<a href="' . route('contractors.show', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>';
                    return $view . ' ' . $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('contractors.index');
    }

    public function create()
    {
        return view('contractors.create');
    }
    function show($id){
        $contractor = Contractor::find($id);
        return view('contractors.show', compact('contractor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'work_area' => 'nullable|string',
            'note' => 'nullable|string',
            'rate' => 'nullable|string',
            'status' => 'required|string|max:1'
        ]);

        Contractor::create($request->all());

        return redirect()->route('contractors.index')->with('success', 'Contractor created successfully.');
    }

    public function edit($id)
    {
        $contractor = Contractor::find($id);
        return view('contractors.edit', compact('contractor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'work_area' => 'nullable|string',
            'note' => 'nullable|string',
            'rate' => 'nullable|string',
            'status' => 'required|string|max:1'
        ]);

        $contractor = Contractor::find($id);
        $contractor->update($request->all());

        return redirect()->route('contractors.index')->with('success', 'Contractor updated successfully.');
    }

    public function destroy($id)
    {
        Contractor::find($id)->delete();
        return redirect()->route('contractors.index')->with('success', 'Contractor deleted successfully.');
    }
}
