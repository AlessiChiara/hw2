<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A.P.S. Toraryukan Shibu Dojo</title>

  <link rel="shortcut icon" href="images/favicon.webp">

  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet" href="style/update_address.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  

 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Catamaran:wght@600;700;800;900&family=Rubik:wght@400;500;800&display=swap"
    rel="stylesheet">
</head>
<body>




<section class="form-container">

   <form action="update_address" method="post">
    @csrf
      <h3>il tuo indirizzo</h3>
      <input type="text" class="box" placeholder="indirizzo" required maxlength="50" name="indirizzo">
      <input type="text" class="box" placeholder="numero civico" required maxlength="50" name="num_civico">
      <input type="text" class="box" placeholder="nome città" required maxlength="50" name="citta">
      <input type="text" class="box" placeholder="provincia" required maxlength="2" name="comune">
      <input type="text" class="box" placeholder="stato" required maxlength="50" name="stato">
      <input type="number" class="box" placeholder="codice postale" required max="999999" min="0" maxlength="6" name="codice_postale">
      <input type="submit" value="salva indirizzo" name="submit" class="btn">
   </form>

</section>



<script>
    const BaseURL = "{{url('/') }}/";
  </script>
<script src="{{ asset('js/index.js')}}" defer></script>
</body>
</html>