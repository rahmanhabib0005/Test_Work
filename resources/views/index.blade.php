<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <title>Comments</title>
</head>
<body>
     <div class="container">
          @foreach ($user as $item)
             <table class="table table-primary table-striped table-hover table-bordered table-sm table-responsive-sm">
               <thead>
                    <tr>
                         <th scope="col">Comments</th>
                         <th scope="col">User</th>
                         <th scope="col">Post</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <th scope="row">{{$item->comment}}</th>
                         <td>{{$item->user->name}}</td>
                         <td>{{$item->post->description}}</td>
                    </tr>
               </tbody>
             </table>
          @endforeach
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>