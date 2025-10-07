<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A.P.S. Toraryukan Shibu Dojo</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="images/favicon.webp">

  <link rel="stylesheet" href="{{ asset('style/index.css') }}">
  <link rel="stylesheet" href="{{ asset('style/classes.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Catamaran:wght@600;700;800;900&family=Rubik:wght@400;500;800&display=swap"
    rel="stylesheet">



</head>

<body id="top">

    <header class="header" data-header>
      <div class="container">
  
        <a href="{{ route('home') }}" class="logo">
          <img src="images/favicon.webp">
  
          <span class="span">Toraryukan Shibu Dojo</span>
        </a>
  
        <nav class="navbar" data-navbar>
  
          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-sharp" aria-hidden="true"></ion-icon>
          </button>
  
          <ul class="navbar-list">
  
            <li>
              <a href="{{ route('home') }}" class="navbar-link" data-nav-link>Home</a>
            </li>
  
            <li>
              <a href="{{ route('about') }}" class="navbar-link" data-nav-link>About Us</a>
            </li>
  
            <li>
              <a href="{{ route('classes') }}" class="navbar-link" data-nav-link>Classes</a>
            </li>

            <li>
              <a href="{{ route('allenamenti') }}" class="navbar-link" data-nav-link>Allenamenti</a>
            </li>

            <li>
              <a href="#contact" class="navbar-link" data-nav-link>Contact Us</a>
            </li>

          </ul>
  
        </nav>
        <a href="{{ route('profile') }}" class="profile-icon" aria-label="Profile">
          <ion-icon name="person-circle-outline"></ion-icon>
        </a>
  
        <a href="logout" class="btn btn-secondary">Logout</a>
  
        <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </button>
  
      </div>
    </header>
    
    
    <section class="section__container price__container">
      <h2 class="section__header">SCEGLI IL TUO PIANO</h2>
      <p class="section__subheader">
        Il nostro piano tariffario include diversi livelli di abbonamento, 
        ciascuno progettato per soddisfare diverse preferenze.
        <em>(Il pagamento si effettuerà in struttura)</em>
      </p>
        <div class="price__grid">
          @foreach ($corsi as $course)
              <form action="" method="post" data-course-id="{{ $course->id }}" class="course-form">
                  <div class="price__card">
                      <div class="price__card__content">
                          <h4>{{ $course->name }}</h4>
                          <h3 id="price-{{ $course->id }}" data-mensile="{{ $course->prezzo }}">{{ $course->prezzo }}€</h3>
                          <label for="scegli-piano-{{ $course->id }}">Scegli piano:</label>
                          <select id="scegli-piano-{{ $course->id }}" name="plan" data-course-id="{{ $course->id }}">
                              <option value="mensile">Mensile</option>
                              <option value="semestrale">Semestrale</option>
                              <option value="annuale">Annuale</option>
                          </select>
                      </div>
                      <button type="submit" class="btn price__btn">Join Now</button>
                  </div>
              </form>
          @endforeach
        </div>
    </section>





  <footer class="footer" id="contact">

    <div class="section footer-top bg-dark has-bg-image" style="background-image: url('images/footer-bg.png')">
      <div class="container">

        <div class="footer-brand">

          <p class="footer-brand-text">
            Orari di apertura:
          </p>

          <div class="wrapper">

            <img src="images/footer-clock.png" width="34" height="34" loading="lazy" alt="Clock">

            <ul class="footer-brand-list">

              <li>
                <p class="footer-brand-title">Lunedi - venerdi</p>

                <p>7:00Am - 10:00Pm</p>
              </li>

              <li>
                <p class="footer-brand-title">Sabato</p>

                <p>7:00Am - 2:00Pm</p>
              </li>

            </ul>

          </div>

        </div>


        <ul class="footer-list">

          <li>
            <p class="footer-list-title has-before">Contact Us</p>
          </li>

          <li class="footer-list-item">
            <div class="icon">
              <ion-icon name="location" aria-hidden="true"></ion-icon>
            </div>

            <address class="address footer-link">
            Via Antonino Giuffrida, 2, 95045 Misterbianco CT
            </address>
          </li>

          <li class="footer-list-item">
            <div class="icon">
              <ion-icon name="call" aria-hidden="true"></ion-icon>
            </div>

            <div>
              <a href="tel:18001213637" class="footer-link">1800-121-3637</a>

              <a href="tel:+915552348765" class="footer-link">+91 555 234-8765</a>
            </div>
          </li>

          <li class="footer-list-item">
            <div class="icon">
              <ion-icon name="mail" aria-hidden="true"></ion-icon>
            </div>

            <div>
              <a href="asdtoraryukan@hotmail.com" class="footer-link">asdtoraryukan@hotmail.com</a>

             
            </div>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title has-before">Our Newsletter</p>
          </li>

          <li>
            <form action="" class="footer-form">
              <input type="email" name="email_address" aria-label="email" placeholder="Email Address" required
                class="input-field">

              <button type="submit" class="btn btn-primary" aria-label="Submit">
                <ion-icon name="chevron-forward-sharp" aria-hidden="true"></ion-icon>
              </button>
            </form>
          </li>

          <li>
            <ul class="social-list">

              <li>
                <a href="https://www.facebook.com/toraryukan.dojo?locale=it_IT" class="social-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li>
                <a href="https://www.instagram.com/toraryukandojo/" class="social-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

              </li>

            </ul>
          </li>

        </ul>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; toraryukan dojo. All Rights Reserved By Chiara Alessi
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link has-before">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link has-before">Terms & Condition</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="caret-up-sharp" aria-hidden="true"></ion-icon>
  </a>


  <script src="{{ asset('js/index.js') }}" defer></script>
  <script src="{{ asset('js/iscrizione.js') }}" defer></script>
  <script>
    const BaseURL = "{{url('/') }}/";
  </script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>