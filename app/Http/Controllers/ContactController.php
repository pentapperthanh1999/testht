<?php

namespace App\Http\Controllers;

use DB, Auth, PDF;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;

class ContactController extends Controller
{
    public function index()
    {
    	return view('contact');
    }

    public function send_mail(Request $request)
    {
        $this->validate($request, [
            'email_address' => 'required',
            'title' => 'required',
            'content' => 'required',
		]);

    		$data = array(
            'email_address' => $request->email_address,
            'title' => $request->title,
            'content' => $request ->content,
        );

    	$pdf = PDF::loadView('contact_form',$data);

    	Mail::send('contact_form', $data, function ($message) use ($data,$pdf) {
    		$message->from('pentapperthanh3@gmail.com');
    		$message->to($data['email_address'])->subject('Feedback');
    		$message->attachData($pdf->output(), 'file.pdf');

    	});
        return redirect()->back()->with('success','Success!');
    }

}