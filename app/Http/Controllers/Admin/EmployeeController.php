<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empList = DB::table('employees')
                ->join('companies', 'employees.company_id','=', 'companies.id')
                ->select('employees.*','name')
                ->paginate(10);

        return view('admin.index', compact('empList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compList = Companies::all();
        return view('admin.emp.newEmp', compact('compList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'email' => 'required | email | unique:employees',
            'phone' => 'required | max:11 | unique:employees',
        ]);
        Employees::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('admin')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compList = Companies::all();
        $employee = Employees::find($id);
        return view('admin.emp.updateEmp', compact(['employee','compList']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        Employees::where('id', $id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company_id' => $request->company_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
        return redirect()->route('admin')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employees::where('id', $id)->first();
        if($employee) {
            $employee->delete();
        }
        return redirect()->route('admin')->with('success', 'Employee deleted successfully');
    }
}
