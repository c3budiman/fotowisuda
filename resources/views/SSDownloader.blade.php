<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foto Wisuda Tools by c3budiman</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
      <div class="row">
        <a style="" href="/" class="btn btn-info">Home</a>
        <a class="btn btn-primary" href="/fotograyscale">Checker and Grayscale</a>
        <a style="" class="btn btn-warning" href="/matcher">Count And List Missing</a>
        <a style="" class="btn btn-success" href="/datadbf">Data DBF Getter</a>
      </div>
      <div class="row">
        <h1 class="page-header">SS Downloader <small>by c3budiman</small></h1>
        <p style="margin-top:-15px">Jangan Masukkin Lebih Dari 100 data dalam satu hit yak adek adek sekalian.... kalau kurang nya banyak coba lagi download pakai tools yg odbc itu.... jadikan tools ini pilihan terakhir karena mungkin foto nya tidak sesuai harapan</p>
        <br>
      </div>
      <div class="row">
        <div class="col-md-12">
          @if (session('status'))
            <div class="alert alert-info alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('status') }}
            </div>
          @endif
          <form class="" action="{{url(action("SSController@ProsesDownload"))}}" method="post">
            {{ csrf_field() }}
            <label for="">Masukkan NPM yg ingin di download : </label>
            <br>
            <textarea class="form-control" name="npm" rows="8" cols="80" placeholder="ex:11115442,10115810"></textarea>
            <br>
            <label class="" for="">Masukkan Password SCP : </label>
            <br>
            <input type="password" name="password" class="form-control" value="">
            <br>
            <input class="btn btn-info" type="submit" name="submit" value="submit">
          </form>
        </div>
      </div>
    </div>


  </body>
</html>
