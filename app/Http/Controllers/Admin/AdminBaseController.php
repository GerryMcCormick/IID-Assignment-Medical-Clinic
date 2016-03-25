<?php namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class AdminBaseController extends Controller {

    use ValidatesRequests;

    public function __construct(){
        $this->middleware('isAdmin');
    }

    protected function formatFilename($filename){
        return preg_replace("([^a-zA-Z0-9\._-])", '', $filename);
    }
}