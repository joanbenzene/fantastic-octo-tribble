<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        return view('booking');
    }

    public function store(Request $request)
    {

        $user = Auth::user()->username;

        $files = new Files;

        $fileName = time() . '_' . $request->file('passport')->getClientOriginalName();
        $filePath = $request->file('passport')->storeAs('uploads', $fileName, 'public');

        $carteName = time() . '_' . $request->file('carte')->getClientOriginalName();
        $cartePath = $request->file('carte')->storeAs('uploads', $carteName, 'public');

        $files->user = Auth::user()->username;
        $files->passport = '/storage/' . $filePath;
        $files->carte = '/storage/' . $cartePath;
        $files->save();

        route("pay");
    }

    public function payement(Request $request)
    {
        return view("pay");
    }
    // I cant hear anything .... please write down your issues
    // When we submit the request through a POST method from a form, we receive and error.
    // what is the ieeor?
    public function pay(Request $request)
    {
        $url = 'https://api.limopay.net/payment';
        $fields = array(
            // shop validity check || you will get it from merchant shop setting
            'publicKey' => urlencode('9a2de70ead2bf3541b8435dadbbf428c'),
            'secretKey' => urlencode('45c01443922ff08491a12e6a9e661b714d95af55b9afb7d1f7e057a676348d12'),
            'receiverName' => urlencode('Borix102'),
            // customer auth check
            'senderName' => urlencode('Borix102'),
            "otp" => urlencode('503566'),
            // cart/product/bill info
            'billingDate' => urlencode('2020-11-14 15:37:25.729963'),
            'billingNote' => urlencode('Lorem Ipsom...'),
            'shopID' => urlencode('102102588455'),
            'curtItem' => array(
                array(
                    'itemID' => '987654321',
                    'title' => 'productname',
                    'quantity' => '1',
                    'BasePrice' => '1',
                    'totalPrice' => '1'
                ), array(
                    'itemID' => '987654321',
                    'title' => 'productname',
                    'quantity' => '1',
                    'BasePrice' => '1',
                    'totalPrice' => '1'
                )
            ),
            'invoiceAmount' => urlencode('1'),
            'deliveryCharge' => urlencode('0'),
            'vatTax' => urlencode('0'),
            'extraCharge' => urlencode('0'),
            'totalAmount' => urlencode('1'),
        );

        $fields_string = json_encode($fields);

        // Will change the api keys and retry

        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: rGmxG8zDm28Zk7iCsHAR99exa272wpNC1IJ9rnez', // you will get it from developer menu (Payments API)
            'Content-Type: application/json'
        ]);

        //execute post
        $result = curl_exec($ch);
        echo "<pre>";
        print_r($result);
        // print_r($result);
        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
        } else {
            //close connection
            curl_close($ch);
        }
    }
}
