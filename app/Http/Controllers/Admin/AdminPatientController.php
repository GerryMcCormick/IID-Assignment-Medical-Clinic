<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPatientController extends AdminBaseController
{

    //private $imageFilePath;
    

    function __construct()
    {
        
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$patients = Patient::latest()->paginate(20);
		return view('admin.patient.index', compact('patients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    
		$users = User::lists('name', 'id');
		return view('admin.patient.create')->with('users',$users);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$patient = Patient::create($request->all());

        

		return redirect('admin/patient');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient = Patient::findOrFail($id);
		return view('admin.patient.show', compact('patient'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$patient = Patient::findOrFail($id);
		
		$users = User::lists('name', 'id');
		//return view('admin.patient.edit', compact('patient'));
		return view('admin.patient.edit')->with('patient', $patient)->with('users',$users);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$patient = Patient::findOrFail($id);
		$patient->update($request->all());
		
		return redirect('admin/patient');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleted = Patient::find($id)->delete();
        return json_encode($deleted);
	}

}
