@extends('layouts.auth')

@section('content')
            <div class="">
                <div class="">
                    <form method="POST" class="register-form" action="{{ route('register') }}">
                        @csrf

                        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span>{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
                        <p class="message">Already registered? <a href="{{ url('/login') }}">Sign In</a></p>
                    </form>
                </div>
            </div>
@endsection

