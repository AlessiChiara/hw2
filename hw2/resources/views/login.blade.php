@if (session('message'))
    <div class="message">
        <span>{{ session('message') }}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.webp') }}">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('style/login_form.css') }}">
    <script src="{{ asset('js/login.js') }}" defer></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>



<body>
    <div class="wrapper">
        
        <form id="loginForm" action="{{ route('doLogin') }}" method="POST">
        @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" name="submitBtn" class="btn">Login</button>

            <div class="register-link">
                <p>Non hai un account? <a href="register">Registrati</a></p>
            </div>
        </form>
    </div>
</body>

</html>
