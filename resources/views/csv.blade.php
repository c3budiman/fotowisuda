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
        <h1 class="page-header">Database Wisudawan <small>by c3budiman</small></h1>
        <p style="margin-top:-15px">Jika ingin pakai data dbf generator perlu upload data dulu kesini okay :D</p>
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
          @if($errors->any())
          <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{$errors->first()}}
          </div>
          @endif
          <form class="" action="{{url(action("SSController@import"))}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="">Masukkan File Csv yang telah kau convert dari dbf : </label>
            <br>
            <input type="file" name="imported-file" accept=".csv">
            <br>
            <input class="btn btn-info" type="submit" name="submit" value="upload">
          </form>
        </div>
      </div>
    </div>


  </body>
</html>
