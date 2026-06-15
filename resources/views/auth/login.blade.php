<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Log In</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Instrument Sans', sans-serif; background: #FDFDFC; }
                body.dark { background: #0a0a0a; color: #EDEDEC; }
                .container { min-height: 100vh; display: flex; flex-direction: column; }
                .nav-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 32px; background: white; border-bottom: 1px solid #e3e3e0; }
                body.dark .nav-header { background: #1D1D1C; border-color: #3E3E3A; }
                .logo { font-size: 20px; font-weight: 700; color: #dc2626; }
                .nav-links { display: flex; gap: 16px; }
                .nav-btn { padding: 8px 16px; border: 1px solid #19140035; background: transparent; color: #1b1b18; border-radius: 6px; text-decoration: none; font-size: 14px; cursor: pointer; transition: all 0.3s; font-family: 'Instrument Sans', sans-serif; }
                body.dark .nav-btn { color: #EDEDEC; border-color: #3E3E3A; }
                .nav-btn:hover { border-color: #1915014a; background: #f5f5f4; }
                body.dark .nav-btn:hover { background: #2D2D2C; border-color: #62605b; }
                .nav-btn.primary { background: #1b1b18; color: white; border: 1px solid #1b1b18; }
                body.dark .nav-btn.primary { background: #eeeeec; color: #1C1C1A; border-color: #eeeeec; }
                .nav-btn.primary:hover { background: #333; }
                body.dark .nav-btn.primary:hover { background: white; }
                .login-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 32px; }
                .login-wrapper { display: flex; width: 100%; max-width: 1200px; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
                .login-left { display: none; width: 50%; background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); color: white; padding: 48px; display: flex; flex-direction: column; justify-content: center; align-items: flex-start; }
                .login-left h1 { font-size: 48px; font-weight: 700; margin-bottom: 24px; }
                .login-left p { font-size: 18px; color: rgba(255,255,255,0.9); line-height: 1.6; }
                .login-right { width: 100%; padding: 48px 32px; background: white; display: flex; flex-direction: column; justify-content: center; }
                body.dark .login-right { background: #161615; }
                @media (min-width: 1024px) {
                    .login-left { display: flex; }
                    .login-right { width: 50%; }
                }
                .form-group { margin-bottom: 20px; }
                label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px; color: #1b1b18; }
                body.dark label { color: #EDEDEC; }
                input { width: 100%; padding: 12px 16px; border: 1px solid #e3e3e0; border-radius: 8px; font-size: 14px; transition: all 0.3s; font-family: 'Instrument Sans', sans-serif; }
                body.dark input { background: #1D1D1C; border-color: #3E3E3A; color: #EDEDEC; }
                input:focus { outline: none; border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1); }
                input[aria-invalid="true"] { border-color: #dc2626; }
                .form-header { margin-bottom: 32px; }
                .form-header h2 { font-size: 32px; font-weight: 700; color: #1b1b18; margin-bottom: 8px; }
                body.dark .form-header h2 { color: #EDEDEC; }
                .form-header p { font-size: 14px; color: #706f6c; }
                body.dark .form-header p { color: #A1A09A; }
                .checkbox-wrapper { display: flex; align-items: center; justify-content: space-between; margin: 24px 0; }
                .checkbox-group { display: flex; align-items: center; gap: 8px; }
                input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }
                .forgot-password { color: #dc2626; text-decoration: none; font-size: 14px; transition: color 0.3s; }
                .forgot-password:hover { color: #991b1b; }
                .btn-submit { width: 100%; padding: 12px; background: #dc2626; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.3s; margin-top: 16px; font-family: 'Instrument Sans', sans-serif; }
                .btn-submit:hover { background: #991b1b; }
                .btn-submit:active { transform: scale(0.98); }
                .register-link { text-align: center; margin-top: 24px; font-size: 14px; color: #706f6c; }
                body.dark .register-link { color: #A1A09A; }
                .register-link a { color: #dc2626; text-decoration: none; font-weight: 600; }
                .register-link a:hover { text-decoration: underline; }
                .error-message { background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
                body.dark .error-message { background: #7f1d1d; border-color: #b91c1c; color: #fecaca; }
                .success-message { background: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
                body.dark .success-message { background: #134e4a; border-color: #14b8a6; color: #d1fae5; }
                .error-text { color: #dc2626; font-size: 12px; margin-top: 4px; display: block; }
            </style>
        @endif
    </head>
    <body>
        <div class="container">
            <nav class="nav-header">
                <div class="logo">{{ config('app.name', 'Laravel') }}</div>
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-btn primary">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-btn">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="nav-btn">Register</a>
                        <a href="{{ route('login') }}" class="nav-btn primary">Log In</a>
                    @endauth
                </div>
            </nav>

            <div class="login-container">
                <div class="login-wrapper">
                    <div class="login-left">
                        <h1>Welcome Back</h1>
                        <p>Manage your account, access your dashboard, and continue building amazing applications.</p>
                    </div>

                    <div class="login-right">
                        <div class="form-header">
                            <h2>Sign In</h2>
                            <p>Enter your credentials to continue</p>
                        </div>

                        @if ($errors->any())
                            <div class="error-message">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="success-message">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email"
                                    name="email" 
                                    value="{{ old('email') }}"
                                    placeholder="you@example.com"
                                    required
                                    {{ $errors->has('email') ? 'aria-invalid="true"' : '' }}
                                >
                                @error('email')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    placeholder="••••••••"
                                    required
                                    {{ $errors->has('password') ? 'aria-invalid="true"' : '' }}
                                >
                                @error('password')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkbox-wrapper">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" style="margin-bottom: 0; cursor: pointer; user-select: none;">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                                @endif
                            </div>

                            <button type="submit" class="btn-submit">Sign In</button>

                            <div class="register-link">
                                Don't have an account? 
                                <a href="{{ route('register') }}">Create one</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
