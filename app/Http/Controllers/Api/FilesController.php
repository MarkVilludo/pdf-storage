<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\File;
use Storage;
use Mail;

class FilesController extends Controller
{
    //
    public function __construct(File $file) {
    	$this->file = $file;
    }

    //get list or search file (s)
    public function index(Request $request)
    {	
    	if ($request->file_name) {
    		//check file is exist
    		$data = FileResource::collection($this->file->where('file_name', 'LIKE', "%$request->file_name%")->get());
    	} else {
			$data = FileResource::collection($this->file->get());
    	}
    	return response()->json($data);
    }

    //Send email the selected item
    public function sendToEmail(Request $request)
    {

    	$data = array('name'=>"Mark Villudo");
      	Mail::send([], $data, function($message) use ($request) {
	         $message->to(env('MAIL_USERNAME'), 'Tutorials Point')->subject
	            ('Activity Search Pdf files and send via email (test PDF file)');
	         $message->attach("http://www.africau.edu/images/default/sample.pdf");
	         $message->from('markanthony.villudo@gmail.com','Mark Villudo');
      	});

      	$data['message'] = "Email Sent with attachment. Check your inbox.";

    	return response()->json($data);

    }
}
