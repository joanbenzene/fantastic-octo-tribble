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
        echo "Paiement";
    }
}
