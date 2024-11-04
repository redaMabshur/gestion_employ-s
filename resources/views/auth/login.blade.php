<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary meta tags and CSS -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- CSS Links -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/loginAssets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/loginAssets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">

    <style>
        body {
            background-color: white;
        }

        /* Custom CSS */
        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Adjusted styling */
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10%;
        }

        .img-container {
            flex: 1;
            display: flex;
            justify-content: center; /* Center the image */
            align-items: center;
        }

        .img-container img {
            max-width: 100%;
            height: auto;
        }

        .form-container {
            flex: 1;
            padding: 20px;
            text-align: center; /* Center the form content */
            background-color: white; /* Same background color as image */
            border: 2px solid white; /* Create a frame around the form */
            border-radius: 10px; /* Slight rounding of the corners */
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center form elements */
            width: 100%; /* Ensure the form elements take up the full width */
        }

        /* Add margin to separate the form and image */
        .col-md-6 {
            margin: 10px;
        }

    </style>
</head>

<body>
    <div class="container">
        <!-- Row containing the image and form -->
        <div class="row">
            <!-- Image on the left -->
            <div class="col-md-6 img-container">
                <img src="{{ asset('AA.png') }}" alt="Image" class="img-fluid">
            </div>

            <!-- Form on the right -->
            <div class="col-md-6 form-container">

                
                <!-- Form -->

                <h1>Connectez-vous </h1>
                <form method="post" action="{{ route('handlelogin') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="email" name="email" class="email form-control" placeholder="Email">
                        @error('email')
                            <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="email form-control" placeholder="Mot de passe">
                        @error('password')
                            <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include necessary JavaScript -->
    <script src="{{ asset('assets/loginAssets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/loginAssets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/loginAssets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/loginAssets/js/main.js') }}"></script>
</body>

</html>
