<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index(){
        return view('booking');
    }

    public function store(Request $request){

        $user = Auth::user()->username;

        $files = new Files;

        $fileName = time().'_'.$request->file('passport')->getClientOriginalName();
        $filePath = $request->file('passport')->storeAs('uploads', $fileName, 'public');

        $carteName = time().'_'.$request->file('carte')->getClientOriginalName();
        $cartePath = $request->file('carte')->storeAs('uploads', $carteName, 'public');

        $files->user = Auth::user()->username;
        $files->passport = '/storage/' . $filePath;
        $files->carte = '/storage/' . $cartePath;
        $files->save();

        route("pay");
    }

    public function payement(Request $request){
        return view("pay");
    }

    public function pay(Request $request){
        $url    = 'https://api.limopay.net/payment';
        $fields = {
            "publicKey":"f65ds4fg891f51d894g5dfg",
            "secretKey":"df7g46df5gdf1g56df1g56df1g6df6a761d76e26bdd5c69d1c627177cc70c9fdcd6f62687cc",
            "senderName":"personal",
            "otp":"123456",
            "receiverName":"business",
            "billingDate":"2020-11-14 15:37:25.729963",
            "billingNote":"Lorem Ipsom...",
            "shopID":"105679648144",
            "curtItem":[
               {
                  "itemID":"987654321",
                  "title":"Styledonia",
                  "quantity":"2",
                  "BasePrice":"15",
                  "totalPrice":"30"
               },
               {
                  "itemID":"5489423164",
                  "title":"Crunch",
                  "quantity":"6",
                  "BasePrice":"5",
                  "totalPrice":"30"
               },
               {
                 "itemID":"987654321",
                 "title":"Mineral Water",
                 "quantity":"1",
                 "BasePrice":"15",
                 "totalPrice":"15"
                }
            ],
            "invoiceAmount":"85",
            "deliveryCharge":"10",
            "vatTax":"5",
            "extraCharge":"0",
            "totalAmount":"100"
        }

        try {
            $fields_string = json_encode($fields, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {

        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: gaPOMlGK4K4tOm8yTTnOF3xcK5DMGPGI4hopzUcz',
            'Content-Type: application/json'
        ]);

        $result = curl_exec($ch);

        echo "<pre>";
        print_r($result);

        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
        } else {
            curl_close($ch);
        }
    }
}
