<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Address;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAddressController extends AdminBaseController
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
		$addresses = Address::latest()->paginate(20);
		return view('admin.address.index', compact('addresses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    
		return view('admin.address.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$address = Address::create($request->all());

        

		return redirect('admin/address');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$address = Address::findOrFail($id);
		return view('admin.address.show', compact('address'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$address = Address::findOrFail($id);
		
		//return view('admin.address.edit', compact('address'));
		return view('admin.address.edit')->with('address', $address);
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
		$address = Address::findOrFail($id);
		$address->update($request->all());
		
		return redirect('admin/address');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleted = Address::find($id)->delete();
        return json_encode($deleted);
	}

}
