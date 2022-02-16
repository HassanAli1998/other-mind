<?php

namespace App\Http\Controllers\twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function sendSms(Request $request)
    {
        $sid = getenv('TWILIO_SID');
        $token = getenv('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);
        $message = $twilio->messages->create($request->get('mobile_number'),
            [
                "body" => $request->get('message'),
                "from" => getenv('TWILIO_NUMBER')
            ]
        );
        $data = [
            'message' =>'Sms sent to '.$request->get('mobile_number')
        ];
        return response()->json($data);
    }
}
