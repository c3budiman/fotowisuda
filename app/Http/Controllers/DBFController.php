<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DBFController extends Controller
{
  public function getIndex() {
    return view('dbfDataIndex');
  }
  
  public function Cari(Request $request) {
    $npmRequest = $request->npm;
    $npmArray = explode(",",$npmRequest);
    return view('result', ['npmArray'=>$npmArray]);
  }
}
