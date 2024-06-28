<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PMI AidHub</title>
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  
  <!-- Stylesheet -->
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    body {
      background-color: #ffffff;
    }
    .background {
      width: 430px;
      height: 520px;
      position: absolute;
      transform: translate(-50%, -50%);
      left: 50%;
      top: 50%;
    }
    .background .shape {
      height: 200px;
      width: 200px;
      position: absolute;
      border-radius: 50%;
    }
    .shape:first-child {
      background: linear-gradient(#ff0000, #ffffff);
      left: -80px;
      top: -80px;
    }
    .shape:last-child {
      background: linear-gradient(to right, #ffffff, #ff0000);
      right: -30px;
      bottom: -80px;
    }
    form {
      height: 850px;
      width: 400px;
      background-color:  rgba(174, 0, 0, 0.13);
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
      padding: 50px 35px;
    }
    form * {
      font-family: 'Poppins', sans-serif;
      color: #ab2525;
      letter-spacing: 0.5px;
      outline: none;
      border: none;
    }
    form h3 {
      font-size: 32px;
      font-weight: 500;
      line-height: 42px;
      text-align: center;
    }
    label {
      display: block;
      margin-top: 30px;
      font-size: 16px;
      font-weight: 500;
    }
    input {
      display: block;
      height: 50px;
      width: 100%;
      background-color: rgba(193, 12, 12, 0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
    }
    ::placeholder {
      color: #ba7a7a;
    }
    button {
      margin-top: 50px;
      width: 100%;
      background-color: #ffffff;
      color: #080710;
      padding: 15px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
    }
    .social {
      margin-top: 30px;
      display: flex;
    }
    .social div {
      background: red;
      width: 350px;
      border-radius: 3px;
      padding: 5px 10px 10px 5px;
      background-color: rgba(255, 255, 255, 0.27);
      color: #c76363;
      text-align: center;
    }
    .social div:hover {
      background-color: rgba(251, 1, 1, 0.47);
    }
    .social i {
      margin-right: 4px;
    }

    .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .alert-danger ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .alert-danger li {
            margin-bottom: 10px;
        }
  </style>
</head>
<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <form method="POST" class="login-form" action="{{ route('register') }}">
    @csrf
    <h3>Register Here</h3>
    
    <div>
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      @if ($errors->has('name'))
          <span>{{ $errors->first('name') }}</span>
      @endif
    </div>
    
    <div>
    <label for="username">{{ __('Username') }}</label>
    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
      @if ($errors->has('username'))
          <span>{{ $errors->first('username') }}</span>
      @endif
    </div>
    
    <div>

    </div>
    <label for="email">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
          <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    
    <div>
    <label for="password">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
     @error('password')
        <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
     @enderror
    </div>    

    <div>
    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
       @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
   


    <button type="submit">{{ __('Register') }}</button>
    <div class="social">
      <a href="{{ route('login') }}"><div class="go"><i class="fas fa-sign-in-alt"></i> Log In</div></a>
    </div>        
  </form>
</body>
</html>
