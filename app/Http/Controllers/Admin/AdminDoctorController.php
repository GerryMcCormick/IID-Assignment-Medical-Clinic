<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDoctorController extends AdminBaseController
{

    //private $imageFilePath;
    private $imageFilePath;
	

    function __construct()
    {
        $this->imageFilePath = '/cms/doctor/image';
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$doctors = Doctor::latest()->paginate(20);
		return view('admin.doctor.index', compact('doctors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    
		return view('admin.doctor.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$doctor = Doctor::create($request->all());

        
                    if($request->file('image')){
                        $uploaded_image_fname = $this->formatFilename($request->file('image')->getClientOriginalName());
                        $request->file('image')->move(public_path() . $this->imageFilePath, $uploaded_image_fname);
                        $doctor->image = $this->imageFilePath . '/' . $uploaded_image_fname;
                        $doctor->save();
                    }
                

		return redirect('admin/doctor');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$doctor = Doctor::findOrFail($id);
		return view('admin.doctor.show', compact('doctor'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$doctor = Doctor::findOrFail($id);
		
		//return view('admin.doctor.edit', compact('doctor'));
		return view('admin.doctor.edit')->with('doctor', $doctor);
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
		$doctor = Doctor::findOrFail($id);
		$doctor->update($request->all());
		
                    if($request->file('image')){
                        $uploaded_image_fname = $this->formatFilename($request->file('image')->getClientOriginalName());
                        $request->file('image')->move(public_path() . $this->imageFilePath, $uploaded_image_fname);
                        $doctor->image = $this->imageFilePath . '/' . $uploaded_image_fname;
                        $doctor->save();
                    }
                
		return redirect('admin/doctor');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleted = Doctor::find($id)->delete();
        return json_encode($deleted);
	}

}
