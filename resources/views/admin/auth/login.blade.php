@extends('omega::admin.guest')

@section('content')
    <!-- Session Status -->
    <div class="mb-4">
        @include('omega::admin.components.auth.auth-session-status', ['status' => session('status')])
    </div>

    <!-- Validation Errors -->
    <div class="mb-4">
        @include('omega::admin.components.auth.auth-validation-errors', ['errors' => $errors])
    </div>

    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("assets/static/images/bg.jpg")'>
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
                    <img class="pos-a centerXY" src="assets/static/images/logo.png" alt="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
            <h4 class="fw-300 c-grey-900 mB-40">Login</h4>

            <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
                <div>
                    {{ Form::label('username', __('Username'), ['label' => 'block font-medium text-sm text-gray-700']) }}

                    {{ Form::text('username', old('username'), ['class' => 'block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50', 'required', 'autofocus']) }}
                </div>

                <!-- Password -->
                <div class="mt-4">
                    {{ Form::label('password', __('Password'), ['label' => 'block font-medium text-sm text-gray-700']) }}

                    {{ Form::password('password', ['class' => 'block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50', 'required', 'autofocus' => 'current-password']) }}
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection