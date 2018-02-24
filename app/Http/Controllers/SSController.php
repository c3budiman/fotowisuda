<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use phpseclib\Net\SSH2;
use phpseclib\Net\SCP;
use Excel;
use App\Dbf;
use Redirect;

class SSController extends Controller
{
    public function GetSSDownloader() {
      return view('SSDownloader');
    }

    public function ProsesDownload(Request $request) {
        $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
        $npmRequest = $request->npm;
        $npmArray = explode(",",$npmRequest);
        $ssh = new SSH2('studentsite.gunadarma.ac.id',143);
        if (!$ssh->login('student', $request->password)) {
            exit('Password Salah!');
        }
        $scp = new SCP($ssh);
        foreach ($npmArray as $npm) {
          $scp->get('/home/student/foto/'.$npm.'.jpg', public_path($pengaturan->FolderDownload.'/'.$npm.'.jpg'));
        }
        return redirect('ssdownloader')->with('status', 'Foto Berhasil Di Download, Jika ada....');
    }

    public function getCsv() {
      return view('csv');
    }

    public function import(Request $request)
    {
      if($request->file('imported-file'))
      {
          $path = $request->file('imported-file')->getRealPath();
          $data = Excel::load($path, function($reader) {
      })->get();
      if(!empty($data) && $data->count())
      {
        $data = $data->toArray();
        // for($i=0;$i<count($data);$i++)
        for($i=0;$i<count(array_chunk($data,1000));$i++)
        {
          $dataImported[] = $data[$i];
        }
      }
      // dd($dataImported);
      try {
          Dbf::insert($dataImported);
          return back()->with('status', 'Berhasil dimasukan Ke Database');
      } catch(\Exception $e){
          return Redirect::back()->withErrors([$e.' terdapat kesalahan format file, pastikan format file sudah benar!']);
      }
    }
    return Redirect::back()->withErrors(['terdapat kesalahan, pastikan format file sudah benar!']);
  }
}
