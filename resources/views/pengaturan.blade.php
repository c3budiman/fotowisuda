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
        <h1 class="page-header">Pengaturan Folder</h1>
        <p style="margin-top:-15px;">Your Public Folder located in : <br> {{public_path()}}</p>
        <p class="small">Folder yang dimasukkan disini harus berada di public yaaa.... jangan lupa permission nya 777</p>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <form class="" action="{{url(action('direktoriController@UpdatePengaturan'))}}" method="post">
            {{ csrf_field() }}
            <label for=""> Folder Asal :</label>
            <input type="text" name="FolderAsal" class="form-control" value="{{$pengaturan->FolderAsal}}">
            <br>
            <label for=""> Folder Result :</label>
            <input type="text" name="FolderResult" value="{{$pengaturan->FolderHasil}}" class="form-control" placeholder="Folder Result">
            <br>
            <label for=""> Folder Gagal :</label>
            <input type="text" name="FolderGagal" value="{{$pengaturan->FolderGagal}}" class="form-control" placeholder="Folder Gagal">
            <br>
            <label for=""> Folder Download :</label>
            <input type="text" name="FolderDownload" value="{{$pengaturan->FolderDownload}}" class="form-control" placeholder="Folder Download">
            <br>
            <input type="hidden" name="_method" value="PUT">
            <input class="btn btn-success pull-right" type="submit" name="submit" value="submit">
          </form>
          <a href="/" class="btn btn-danger">Back</a>
        </div>
      </div>
    </div>


  </body>
</html>
