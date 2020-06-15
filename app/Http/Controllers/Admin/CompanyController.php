<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companies;

class CompanyController extends Controller
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
        $comList = Companies::select('*')
                ->orderBy('id', 'desc')
                ->paginate(10);
        return view('admin.company.comList', compact('comList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.newCom');
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
            'name' => 'required',
            'email' => 'required | email',
            'logo' => 'required | dimensions:min_width=100,min_height=100',
        ]);
        if ($request->file('logo')) {
            $photo = $request->file('logo')->getClientOriginalName();
            $destination = 'storage/app/public';
            $insert = $request->file('logo')->move($destination, $photo);
        }
        Companies::insert([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $insert,
            'website' => $request->website,
        ]);
        return redirect()->route('company.index')->with('success','Company created successfully');
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
        $company = Companies::find($id);
        return view('admin.company.updateCom', compact('company'));
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
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100',
        ]);
        if ($request->file('logo') != null) {
            $photo = $request->file('logo')->getClientOriginalName();
            $destination = 'storage/app/public';
            $insert = $request->file('logo')->move($destination, $photo);
            Companies::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $insert,
                'website' => $request->website,
            ]);
        }
        else {
            Companies::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
            ]);
        }
        
        return redirect()->route('company.index')->with('success', 'Company updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Companies::where('id', $id)->first();
        if($company) {
            $company->delete();
        }
        return redirect()->route('company.index')->with('success', 'Product deleted Successfully');
    }
}
