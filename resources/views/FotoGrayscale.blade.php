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
        <h1 class="page-header">Foto Grayscale And Resize <small>by c3budiman</small></h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" action="{{url(action('direktoriController@proses'))}}" method="post">
            {{ csrf_field() }}
            <label class="" for="">Masukkan list npm yg ingin di grayscale. pisahkan dengan koma ex : (111,222)</label>
            <br>
            <textarea class="form-control" name="npm" rows="8" cols="80"></textarea>
            <br>
            <input class="btn btn-info" type="submit" name="submit" value="submit">
          </form>
        </div>
      </div>
    </div>


  </body>
</html>
