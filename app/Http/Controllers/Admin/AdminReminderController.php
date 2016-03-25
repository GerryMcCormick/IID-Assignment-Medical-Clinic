<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reminder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReminderController extends AdminBaseController
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
		$reminders = Reminder::latest()->paginate(20);
		return view('admin.reminder.index', compact('reminders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    
		return view('admin.reminder.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$reminder = Reminder::create($request->all());

        

		return redirect('admin/reminder');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reminder = Reminder::findOrFail($id);
		return view('admin.reminder.show', compact('reminder'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reminder = Reminder::findOrFail($id);
		
		//return view('admin.reminder.edit', compact('reminder'));
		return view('admin.reminder.edit')->with('reminder', $reminder);
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
		$reminder = Reminder::findOrFail($id);
		$reminder->update($request->all());
		
		return redirect('admin/reminder');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleted = Reminder::find($id)->delete();
        return json_encode($deleted);
	}

}
