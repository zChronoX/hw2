<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Registrazione - GTech Tips - </title>
    <link rel="shortcut icon" type="image/x-icon" href='{{ url('images/logo.png') }}' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href='{{ url('css/register.css') }}'>
    <script src='{{ url('js/register.js') }}' defer></script>
    <script type="text/javascript">
        const REGISTER_ROUTE = "{{url('register')}}";
    </script>
</head>


<body>
    <div id="scroll"></div>

    <div class="login_box">
        <div class="register">
            <div class="register_title">
                <h2>Crea il tuo nuovo account</h2>
                <p>Compila correttamente il form per registrarti!</p>
            </div>
            <div class="register_logo">
                <img src="images/logo.png" alt="">
            </div>
            @if($error == 'empty_fields')
            <span class='errore'>Compila tutti i campi!</span>
            @elseif($error == 'bad_passwords')
            <span class='errore'>Le password inserite non corrispondono!</span>
            @elseif($error == 'existing_username')
            <span class='errore'>Username in uso!</span>
            @elseif($error == 'existing_email')
            <span class='errore'>Email in uso!</span>
            @endif
            <form action="{{ url('register') }}" id='form' class='type_zero' name='form_dati' method='post'>
            @csrf
                <div class="user_box">
                    <label><input type='text' name='Nome' class="textBox" placeholder="Nome" id="Nome" value='{{ old("nome") }}'></label>
                    <span id="textUser"></span>

                    <label><input type='text' name='Cognome' class="textBox" placeholder="Cognome" id="Cognome"></label>
                    <span id="textSurname"></span>
                </div>



                <div class="user_box2">
                    <div class='username'>
                        <label><input type='text' name='Username' class="textBox" placeholder="Username" id="Username" value='{{ old("username") }}'>
                        </label>
                        <span id="textUsername"></span>
                    </div>
                    <div class="wrapper">
                        <label><input type='password' name='Password' class="textBox" placeholder="Password" id="Password" value='{{ old("password") }}'></label>
                        <span id='p'>
                            <i class="fa fa-eye" aria-hidden="true" id="eyeP"></i>
                        </span>
                        <span id="textPassword"></span>
                    </div>
                </div>

                <div class="verifyPassword">
                    <label><input type='password' name='cPassword' class="textBox" placeholder="Conferma Password" id="cPassword"></label>
                    <span id="textPassC"></span>
                </div>

                <div class="user_mail">

                    <label><input type='text' name='Email' class="textBox" id="email" placeholder="E-Mail"  value='{{ old("email") }}'></label>
                    <span id="textEmail"></span>
                </div>

                <h3 class='gb'>Genere</h3>
                <div class="gender_box">
                    <label><input type="radio" class='genere' name="Genere" value="Maschio"> Maschio</label>
                    <label><input type="radio" class='genere' name="Genere" value="Femmina"> Femmina</label>
                </div>


                <div id="zero"><input type='submit' name='submit' value='Registrati'></div>

            </form>
            <div class='signup'>
                <p> Hai già un account? <a href="{{ url('login') }}"> Accedi!</a></p>
            </div>
        </div>
    </div>
</body>

</html>