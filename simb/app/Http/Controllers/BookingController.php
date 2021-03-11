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
        $fields = array(
            'publicKey'        => urlencode('5315067b5797ec3db5358630225f0b46'),
            'secretKey'        => urlencode('7ef8f0bc39bdfb93a7500c34f8d60d95854b98c81632309bf35e7512cc21fb53cc75efd0e4e572c2a2527dd3a3e4f5a915db8989ebea1c67e3906c3641c5a059'),
            'receiverName'     => urlencode('tareqmerchant'),

            'senderName'       => urlencode('usert'),
            "otp"              => urlencode('617268'),

            'billingDate'      => urlencode('2020-11-14 15:37:25.729963'),
            'billingNote'      => urlencode('Lorem Ipsom...'),
            'shopID'           => urlencode('749271417079'),
            'curtItem'         => array(
                array(
                    'itemID'        => '987654321',
                    'title'         => 'productname',
                    'quantity'      => '1',
                    'BasePrice'     => '1',
                    'totalPrice'    => '1'
                ),array(
                    'itemID'        => '987654321',
                    'title'         => 'productname',
                    'quantity'      => '1',
                    'BasePrice'     => '1',
                    'totalPrice'    => '1'
                )
            ),
            'invoiceAmount'    => urlencode('2'),
            'deliveryCharge'   => urlencode('0'),
            'vatTax'           => urlencode('0'),
            'extraCharge'      => urlencode('0'),
            'totalAmount'      => urlencode('2'),
        );
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
