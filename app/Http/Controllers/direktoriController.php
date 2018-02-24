<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Folder;

class direktoriController extends Controller
{
    //proses utama, cek foto -> resize -> hitamkan -> copy
    public function proses(Request $request) {
      $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
      //yg perlu di edit -> $dirfotonya = folder asal foto
      //$dirResult = folder dimana menyimpan hasil itemin
      $dirfotonya = public_path($pengaturan->FolderAsal);
      $fotoArray = scandir($dirfotonya,1);
      // return var_dump($dirfotonya);
      $npmDicari = $request->npm;
      $npmArray = explode(",",$npmDicari);
      $dirResult = public_path($pengaturan->FolderHasil);
      $fotoerror = "";
      $errornya = false;

      foreach ($fotoArray as $foto) {
        foreach ($npmArray as $npm) {
          $npmfoto = str_replace(".jpg","",$foto);
          if ($npmfoto === $npm) {
            // echo "Ketemu ". $npm."<br>";
            $fotoKetemu = $dirfotonya . "/" . $foto;
            $fotoBaru = $dirResult ."/" . $foto;
            $dirError = public_path($pengaturan->FolderGagal);
            $fotoError = $dirError . "/" .$foto;
            //fungsi copy image yg ditemukan ke folder result
            if(copy($fotoKetemu, $fotoBaru)){
              echo "foto ".$npm." telah di copy ";

              //fungsi biar image nya ga kebolak gapake $im = imagecreatefromjpeg($fotoBaru);
              try {
                $img = imagecreatefromjpeg($fotoBaru);
                $exif = exif_read_data($fotoBaru);
                if ($img && $exif && isset($exif['Orientation']))
                {
                    $ort = $exif['Orientation'];

                    if ($ort == 6 || $ort == 5)
                        $img = imagerotate($img, 270, null);
                    if ($ort == 3 || $ort == 4)
                        $img = imagerotate($img, 180, null);
                    if ($ort == 8 || $ort == 7)
                        $img = imagerotate($img, 90, null);

                    if ($ort == 5 || $ort == 4 || $ort == 7)
                        imageflip($img, IMG_FLIP_HORIZONTAL);
                }
              } catch (Exception $e) {
                $errornya = true;
              }
              $errornya = false;

              if ($errornya == true) {
                $img = imagecreatefromjpeg($fotoBaru);
                $fotoerror = $fotoerror.",".$npm;
                copy($fotoBaru, $fotoError);
              }
              //fungsi resize image menggunakan max width dan max height
              //agar image nya tidak jadi aneh ok oc :v
              //parameter nya : $namafile, $max_width, $max_height
              $max_width = 600;
              $max_height = 800;

              list($orig_width, $orig_height) = getimagesize($fotoBaru);
               $width = $orig_width;
               $height = $orig_height;
               # ketinggian
               if ($height > $max_height) {
                   $width = ($max_height / $height) * $width;
                   $height = $max_height;
               }
               # kelebaran
               if ($width > $max_width) {
                   $height = ($max_width / $width) * $height;
                   $width = $max_width;
               }
               $image_p = imagecreatetruecolor($width, $height);
               $image = imagecreatefromjpeg($fotoBaru);
               imagecopyresampled($image_p, $image, 0, 0, 0, 0,
                                                $width, $height, $orig_width, $orig_height);

              //fungsi buat convert image jadi grayscale
              if($image_p && imagefilter($image_p, IMG_FILTER_GRAYSCALE))
              {
                  echo 'dan telah diconvert jadi grayscale. <br>';
                  imagejpeg($image_p, $fotoBaru);
              } else {
                echo 'kesalahan saat convert, image tidak bisa di convert <br>';
              }
            } else {
              echo "masalah dalam copy";
            }
            //tutup if utama
          }
        //tutup foreach 1
        }
        //tutup foreach 2
      }
      //tutup fungsi proses
      echo $fotoerror;
    }

    //tanpa nge cek npm, langsung hitamkan foto yg di folder
    public function proseslangsung() {
      $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
      $dirfotonya = public_path($pengaturan->FolderAsal);
      $fotoArray = scandir($dirfotonya,1);
      $dirResult = public_path($pengaturan->FolderHasil);

      foreach ($fotoArray as $foto) {
          $npmfoto = str_replace(".jpg","",$foto);
          $npm = $npmfoto;
          if ($npmfoto === $npm) {
            // echo "Ketemu ". $npm."<br>";
            $fotoKetemu = $dirfotonya . "/" . $foto;
            $fotoBaru = $dirResult ."/" . $foto;
            $dirError = public_path($pengaturan->FolderGagal);
            $fotoError = $dirError . "/" .$foto;
            //fungsi copy image yg ditemukan ke folder result
            if(copy($fotoKetemu, $fotoBaru)){
              echo "foto ".$npm." telah di copy ";

              //fungsi biar image nya ga kebolak gapake $im = imagecreatefromjpeg($fotoBaru);
              try {
                $img = imagecreatefromjpeg($fotoBaru);
                $exif = exif_read_data($fotoBaru);
                if ($img && $exif && isset($exif['Orientation']))
                {
                    $ort = $exif['Orientation'];
                    if ($ort == 6 || $ort == 5)
                        $img = imagerotate($img, 270, null);
                    if ($ort == 3 || $ort == 4)
                        $img = imagerotate($img, 180, null);
                    if ($ort == 8 || $ort == 7)
                        $img = imagerotate($img, 90, null);
                    if ($ort == 5 || $ort == 4 || $ort == 7)
                        imageflip($img, IMG_FLIP_HORIZONTAL);
                }
              } catch (Exception $e) {
                $errornya = true;
              }
              $errornya = false;

              if ($errornya == true) {
                $img = imagecreatefromjpeg($fotoBaru);
                $fotoerror = $fotoerror.",".$npm;
                copy($fotoBaru, $fotoError);
              }
              //fungsi resize image menggunakan max width dan max height
              //agar image nya tidak jadi aneh ok oc :v
              //parameter nya : $namafile, $max_width, $max_height
              $max_width = 600;
              $max_height = 800;

              list($orig_width, $orig_height) = getimagesize($fotoBaru);
               $width = $orig_width;
               $height = $orig_height;
               # ketinggian
               if ($height > $max_height) {
                   $width = ($max_height / $height) * $width;
                   $height = $max_height;
               }
               # kelebaran
               if ($width > $max_width) {
                   $height = ($max_width / $width) * $height;
                   $width = $max_width;
               }
               $image_p = imagecreatetruecolor($width, $height);
               $image = imagecreatefromjpeg($fotoBaru);
               imagecopyresampled($image_p, $image, 0, 0, 0, 0,
                                                $width, $height, $orig_width, $orig_height);

              //fungsi buat convert image jadi grayscale
              if($image_p && imagefilter($image_p, IMG_FILTER_GRAYSCALE))
              {
                  echo 'dan telah diconvert jadi grayscale. <br>';
                  imagejpeg($image_p, $fotoBaru);
              } else {
                echo 'kesalahan saat convert, image tidak bisa di convert <br>';
              }


            } else {
              echo "masalah dalam copy";
            }

          }

        //tutup foreach 1
        }
        //tutup fungsi proses
      }

    //proses 2 kalo image nya bandel ga bisa di exif....
    public function proses2(){
      $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
      $dirfotonya = public_path($pengaturan->FolderAsal);
      $fotoArray = scandir($dirfotonya);
      // return var_dump($dirfotonya);
      $dirResult = public_path($pengaturan->FolderHasil);
      $dirError = public_path($pengaturan->FolderGagal);
      $fotoerror = "";
      $errornya = false;

      foreach ($fotoArray as $foto) {
        $fotoKetemu = $dirfotonya.$foto;
        $fotoBaru = $dirResult.$foto;
        $fotoError = $dirError.$foto;
        $npm = str_replace(".jpg","",$foto);
        if ($foto == "." || $foto == "..") {
          continue;
        }

        if(copy($fotoKetemu, $fotoBaru)){


          echo "foto ".$npm." telah di copy ";
          $max_width = 600;
          $max_height = 800;

          list($orig_width, $orig_height) = getimagesize($fotoBaru);
           $width = $orig_width;
           $height = $orig_height;
           # ketinggian
           if ($height > $max_height) {
               $width = ($max_height / $height) * $width;
               $height = $max_height;
           }
           # kelebaran
           if ($width > $max_width) {
               $height = ($max_width / $width) * $height;
               $width = $max_width;
           }
           $image_p = imagecreatetruecolor($width, $height);
           $image = imagecreatefromjpeg($fotoBaru);
           imagecopyresampled($image_p, $image, 0, 0, 0, 0,
                                            $width, $height, $orig_width, $orig_height);

          //fungsi buat convert image jadi grayscale
          if($image_p && imagefilter($image_p, IMG_FILTER_GRAYSCALE))
          {
              echo 'dan telah diconvert jadi grayscale. <br>';
              imagejpeg($image_p, $fotoBaru);
          } else {
            echo 'kesalahan saat convert, image tidak bisa di convert <br>';
          }


        } else {
          echo "masalah dalam copy";
        }

      }
    }

    //checker foto yg udah ke kumpul di folder result, apa aja yg masih kurang dari list
    public function matcher(Request $request) {
       $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
       $dirfotonya = public_path($pengaturan->FolderAsal);
       $fotoArray = scandir($dirfotonya);
       $npmDicari = $request->npm;
       $npmArray = explode(",",$npmDicari);
       $npmfoto = str_replace(".jpg","",$fotoArray);
       $fotoArray = "";
       $npmYangGaada = array_diff($npmArray, $npmfoto);
       foreach ($npmYangGaada as $npm) {
         $fotoArray = $fotoArray . "," . $npm;
       }

      echo "<h1> foto yg tidak ditemukan : </h1>";
      echo '<textarea class="form-control" name="npm" rows="8" cols="80">'.$fotoArray.'</textarea>';
      echo "<ol>";
      foreach ($npmYangGaada as $npm) {
        echo "<li>".$npm."</li>";
      }
      echo "</ol>";
    }
    //tutup controller

    //getTheMatcherIndex
    public function matcherIndex() {
      return view('matcher');
    }

    //Pengaturan
    public function GetPengaturan () {
      $pengaturan = DB::table('folder')->where('id','=','1')->get()->first();
      return view('pengaturan', ['pengaturan'=>$pengaturan]);
    }

    public function UpdatePengaturan(Request $request) {
      $folder = Folder::find(1);
      $folder->FolderAsal = $request->FolderAsal;
      $folder->FolderHasil = $request->FolderResult;
      $folder->FolderGagal = $request->FolderGagal;
      $folder->FolderDownload = $request->FolderDownload;
      $folder->save();
      return redirect('pengaturan');
    }
}
