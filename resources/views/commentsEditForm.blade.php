
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Forum - posty</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>StarChess - Forum szachowe</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('/css/custom_style.css') }}" rel="stylesheet">
    
    <style>  
            .box {
                display: flex;
                justify-content: center;
            }
            
    </style>
    
</head>
<body>
    @include('layouts.navbar')
    
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/chess1.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>StarChess</h1>
                            <span class="subheading">Edytuj post!</span>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <div class="container" style="margin-bottom: 30px" >
        
        <div class="row gx-4 gx-lg-5" id="jak">
        
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-primary ">
             <!-- /.box-header -->
             <!-- form start -->
             <form role="form" id="comment-form" method="post" action="{{ route('update', $comment) }}">
                 {{ csrf_field() }}
                 <input name="_method" type="hidden" value="PUT">
                 <div class="box">
                 <div class="box-body">
                 <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}"
                 id="roles_box">
                 <label><b>Treść</b></label><br>
                 <textarea name="message" id="message" cols="50" rows="3" required>
                 {{$comment->message}}
                 </textarea>
                 </div>
                 </div>
                 </div>
                 <div class="box-footer">
                 <button type="submit" class="btn btn-success">Zapisz</button>
                 </div>
             </form>

            </div>
       
        </div>
    </div>
        <!-- Footer-->
        @include('layouts.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>       
</body>
</html>
