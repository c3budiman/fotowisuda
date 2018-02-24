<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foto Wisuda Tools by c3budiman</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1 class="page-header">Foto Wisuda Tools <small>by c3budiman</small></h1>
        <p style="margin-top:-15px;">Your Public Folder located in : <br> {{public_path()}}</p>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <a class="btn btn-block btn-info" href="/fotograyscale">Checker and Grayscale</a>
          <br>
          <a style="margin-top:10px;" class="btn btn-block btn-warning" href="/matcher">Count And List Missing</a>
          <br>
          <a style="margin-top:10px;" class="btn btn-block btn-danger" href="/proses">Direct Grayscale</a>
          <br>
          <a style="margin-top:10px;" class="btn btn-block btn-success" href="/datadbf">Data DBF Getter</a>
          <br>
          <div class="col-md-9 pull-right">
            <a style="margin-top:40px;" class="btn btn-warning pull-right" href="/pengaturan"><i class="fa fa-gear"></i> Pengaturan Folder</a>
            <a style="margin-top:40px; margin-right:20px;" class="btn btn-info pull-right" href="/transpose"><i class="fa fa-gear"></i> Transpose CSV</a>
            <a style="margin-top:40px; margin-right:20px;" class="btn btn-danger pull-right" href="/csv"><i class="fa fa-plus"></i> Isi DB Wisudawan</a>
            <a style="margin-top:40px; margin-right:20px;" class="btn btn-primary pull-right" href="/ssdownloader"><i class="fa fa-download"></i> Foto Downloader From SS</a>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
