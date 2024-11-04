    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Gestion Employe</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/auth.css')}}">
        <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f0f2f5;
        }
        .box {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .email, .password {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            color: #000; /* Black font color */
        }
        .btn-container {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        b.error-msg {
            font-size: 14px;
            color: #b95151;
            display: block;
            margin-top: 10px;
        }
        </style>
    </head>
    <body>

    <form method="post" action="{{route('submitDefineAccess' , $email  )}}" class="container">
    @csrf
    @method('POST')
    <div class="box">
        <h1>Définissez vos accès</h1>

        @if (Session::get('error_msg'))
        <b class="error-msg">{{Session::get('error_msg')}}</b>
        @endif
        
        <div class="form-group">
            <input type="email" id="email" name="email" class="form-control email" placeholder="Entrez votre adresse email" value="{{ $email }}" readonly/>
        </div>
        <div class="form-group">
            <input type="text" id="email" name="code" class="form-control email"  value="{{ old('code') }}"  placeholder="Code"/>
            @error('code')
                <span class="text-danger">{{$message}}</span>               
            @enderror
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control password" placeholder="Mot de Passe" />
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" id="confirm_password" name="confirm_password" class="form-control password" placeholder="Confirmer le Mot de passe" />
            @error('confirm_password')
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </div>
    </form>

    </body>
    </html>
