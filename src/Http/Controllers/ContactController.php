<?php

namespace Kashana\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kashana\Contact\Models\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact::index');
    }

    public function store(Request $request)
    {
        $validatorRules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email','regex:/(.+)@(.+)\.(.+)/i','max:255'],
            'phone' => ['required','regex:/^[1-9][0-9]*$/','digits_between:9,11'],
            'message' => ['required', 'string', 'max:500'],
        ];    
        try {

            $validator = Validator::make($request->all(),$validatorRules);
            if($validator->fails()) 
            {
                $error = $validator->messages()->first();
                $response = ['status' => false, 'msg' => $error];
                return response()->json($response);
            }

            Contact::create($request->all());
            return response()->json(['status'=>true,'msg'=>'data saved successfully']);

        } catch (\Exception $e) {
            return response()->json(['status'=>false,'msg'=>'Something went wrong']);
        }
       
    }
}
