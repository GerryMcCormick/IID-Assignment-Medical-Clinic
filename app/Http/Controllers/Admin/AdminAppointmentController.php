<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAppointmentController extends AdminBaseController
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
		$appointments = Appointment::latest()->paginate(20);
		return view('admin.appointment.index', compact('appointments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    
		$doctors = Doctor::lists('name', 'id');
		$patients = Patient::lists('name', 'id');
		return view('admin.appointment.create')->with('doctors',$doctors)->with('patients',$patients);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$appointment = Appointment::create($request->all());

        

		return redirect('admin/appointment');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$appointment = Appointment::findOrFail($id);
		return view('admin.appointment.show', compact('appointment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$appointment = Appointment::findOrFail($id);
		
		$doctors = Doctor::lists('name', 'id');
		$patients = Patient::lists('name', 'id');
		//return view('admin.appointment.edit', compact('appointment'));
		return view('admin.appointment.edit')->with('appointment', $appointment)->with('doctors',$doctors)->with('patients',$patients);
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
		$appointment = Appointment::findOrFail($id);
		$appointment->update($request->all());
		
		return redirect('admin/appointment');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleted = Appointment::find($id)->delete();
        return json_encode($deleted);
	}

}
