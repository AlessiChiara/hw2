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
    <title>Registration</title>
    <link rel="stylesheet" href="{{ url('style/registration.css') }}">
    <script src="{{ url('js/registration.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.webp') }}">
   </head>
<body>

  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="{{ route('register') }}" method='POST' id='registerForm'>
        @csrf
        <div class="user-details">
          <div class="input-box">
            <span class="details">Name</span>
            <input type="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
          </div>
          <div class="input-box">
            <span class="details">Number</span>
            <input type="number" name="number" value="{{ old('number') }}" placeholder="Enter your number">
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="address" name="address" value="{{ old('address') }}" placeholder="Enter your address">
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="pass" placeholder="Enter your password">
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="cpass" placeholder="Confirm your password">
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
    </div>
  </div>


<script>
    const BaseURL = "{{url('/') }}/";
</script>

</body>
</html>