<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class direktoriController extends Controller
{
    public function proses(Request $request) {
      $dirfotonya = public_path('/foto');
      $fotoArray = scandir($dirfotonya,1);
      // return var_dump($dirfotonya);
      $npmDicari = $request->npm;
      $npmArray = explode(",",$npmDicari);
      $dirResult = public_path('/result');

      foreach ($fotoArray as $foto) {
        foreach ($npmArray as $npm) {
          $npmfoto = str_replace(".jpg","",$foto);
          if ($npmfoto === $npm) {
            // echo "Ketemu ". $npm."<br>";
            $fotoKetemu = $dirfotonya . "/" . $foto;
            $fotoBaru = $dirResult ."/" . $foto;

            //fungsi copy image yg ditemukan ke folder result
            if(copy($fotoKetemu, $fotoBaru)){
              echo "foto ".$npm." telah di copy ";

              //fungsi biar image nya ga kebolak gapake $im = imagecreatefromjpeg($fotoBaru);
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

          } else {
            echo "npm : ".$npm." tak ditemukan! ";
          }

        //tutup foreach 1
        }
        //tutup foreach 2
      }
      //tutup fungsi proses
    }
    //tutup controller
}
