<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    function store(Request $request)
    {
        $data = $request->all();
        $success = true;
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:255',
            'object' => 'required|min:3|max:255',
            'email' => 'required|min:3|max:255|email',
            'message' => 'required|min:3|max:255'
        ]);

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to('hello@example.com')->send(new NewContact($new_lead));

        return response()->json(compact('success'));
    }
}
