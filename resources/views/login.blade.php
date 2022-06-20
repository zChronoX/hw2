<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Laravel | Login - GTech Tips - </title>
    <link rel="shortcut icon" type="image/x-icon" href='{{ url('images/logo.png') }}' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href='{{ url('css/login.css') }}'>
    <script src='{{ url('js/login.js') }}' defer></script>
</head>

<body>

    <div class="box_login">


        <div class="login_copy">
            <h3>Effettua il login per continuare</h3>
        </div>

        <div class="login">



            <div class="login_logo">
                <img src="images/logo.png" alt="">
            </div>

            @if($error == 'empty_fields')
            <span class='errore'>Compila tutti i campi!</span>
            @elseif($error == 'wrong_credentials')
            <span class='errore'>Credenziali errate!</span>
            @endif



            <form action="{{ url('login') }}" class='type_zero' name='form_dati' method="POST">
                @csrf
                <label><input type='text' name='username' class="textBox" placeholder="Username" id="username" value='{{ old("username") }}'></label>
                <span id="textUser"></span>
                <div class="wrapper">
                    <label><input type='password' name='password' class="textBox" placeholder="Password" id="password"></label>
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" id="eye"></i>
                    </span>
                </div>
                <span id="textPassword"></span>
                <div class='checkbox'>
                    <label><input type="checkbox" id='check' name="ricordami" value="remember">Ricordami</label>
                </div>

                <div id="zero"><input type='submit' value='Accedi'></div>
                <div class="option">OR</div>
            </form>

            <div class="fblink">
                <span class="fab fa-facebook"></span>
                <a href="#">Log in with Facebook</a>
            </div>
            <div class="glink">
                <span class="fab fa-google"></span>
                <a href="#">Log in with Google</a>
            </div>


            <div class="forget-id">
                <a href="#">Password dimenticata</a>
            </div>

            <div class='signup'>
                <p> Non hai un account? <a href="{{ url('register') }}"> Iscriviti!</a> </p>
            </div>

        </div>
    </div>

</body>

</html>