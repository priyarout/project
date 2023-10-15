<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


       
    </head>
    <body>
    <main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-header text-center"><h3>CREATE AN ACCOUNT </h3></div>
                        <div class="card-body">

                        @if ($sentSuccess) 
<p>A verification mail sent to your mail id . please go to your mail and click on the verify link to vefify your registration process.</p>
                        @endif  
                        <form role="form" id="registrationForm" method="POST" action="{{ route('userRegistration') }}" >
                        {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="firstName" class="form-control" name="firstName" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="lastName" class="form-control" name="lastName" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"required>
                                    </div>
                                </div>



                                @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                            
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" id="register" class="btn btn-primary btn-block btn-lg">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <p class="text-center text-muted mt-3 mb-5">Have already an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a></p>
                        </div>
                    </div>
            </div>
        </div>
   
      
</div>

</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    </body>
</html>
