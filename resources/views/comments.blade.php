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
</head>
<body>
    @include('layouts.navbar')
    
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/chess3.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Forum</h1>
                            <span class="subheading">Masz jakieś pytania? A może chcesz komuś pomóc? Zapraszamy na nasze forum o tematyce szachów!</span>
                            @auth
                            <div class="footer-button" style="padding-top: 5%">
                                <a href="{{ route('create') }}" class="btn btn-secondary">Dodaj post</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </header>   
    <!-- Main Content-->
        @auth
        @foreach($comments as $comment)
        <div class="container px-4 px-lg-5 " style="border-bottom: 1px solid black; margin-bottom: 30px" >
            
            <div class="row gx-4 gx-lg-5" id="jak">
                
                    <div id="post" class="row gx-4 gx-lg-5" style="width: 35%; border-bottom: solid black 1px">                      
                        Użytkownik {{$comment->user->name}} o 
                        {{$comment->created_at}}
                    </div>
                    <!-- Post preview-->
                    <div class="row g-0">
                        <div id="no" class="col-7">{{$comment->message}}</div>
                            <br /> @if($comment->user_id == \Auth::user()->id)
                            <div class="col-5 justify-content-lg-end"><a style="width: 140px" href="{{ route('edit', $comment) }}" class="btn btn-success btn-xs" title="Edytuj"> Edytuj </a>
                            <a style="width: 140px" href="{{ route('delete', $comment->id) }}"
                                class="btn btn-danger btn-xs"
                                onclick="return confirm('Jesteś pewien?')"
                                title="Skasuj"> Usuń
                            </a>
                            <a style="width: 140px" href="{{ route('create_thread', $comment) }}" class="btn btn-success btn-xs" title="Skomentuj"> Skomentuj </a>
                            </div>
                            
                            @else
                            
                            <div class="col-1 justify-content-lg-end">
                                <a style="width: 140px" href="{{ route('create_thread', $comment) }}" class="btn btn-success btn-xs" title="Skomentuj"> Skomentuj </a>
                            </div>
                            @endif
                    </div>
                    
                    
            </div>
            
        </div>
        @endforeach
        
        @endauth
        
        @guest
        <div class="container px-4 px-lg-5" style="background-color: red; display: flex; justify-content: center" >Zaloguj się, aby uzyskać dostęp do dodawania oraz komentowania postów!</div>  
        @foreach($comments as $comment)
        <div class="container px-4 px-lg-5 " style="border-bottom: 1px solid black; margin-bottom: 30px" > 
            <div class="row gx-4 gx-lg-5" id="jak">
                
                    <div id="post" class="row gx-4 gx-lg-5" style="width: 35%; border-bottom: solid black 1px">                      
                        Użytkownik {{$comment->user->name}} o 
                        {{$comment->created_at}}
                    </div>
                    <!-- Post preview-->
                    <div class="row g-0">
                        <div class="col-9">{{$comment->message}}</div>
                            
                    </div>
                    
            </div>
        </div>
        @endforeach
        @endguest
        <!-- Footer-->
        @include('layouts.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>       
</body>
</html>
