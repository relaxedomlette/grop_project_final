<?php
session_start();
require_once "db_connection.php";
require_once "navbar.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./style/index.css">
  <link rel="stylesheet" href="./style/contactus.css">
</head>

<body>
  <div class="containerContact">
    <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.5281052303094!2d16.359416000000003!3d48.196442999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476da8192fde39d7%3A0xe543f0731e2b5529!2sCodeFactory!5e0!3m2!1sen!2sat!4v1714038121044!5m2!1sen!2sat" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div>
      <div class="contactBox">
        <div class="boxRow">
          <div class="rowContent">
            <h3>Opening Hours</h3>
            <div class="rowContentFlex">
              <p>9:00 - 19:30</p>
              <p>Monday<br> - Friday</p>
            </div>
            <div class="rowContentFlex">
              <p>8:30 - 18:00</p>
              <p>Saturday</p>
            </div>
          </div>
          <div class="rowContent">
            <h3>Contact Hours</h3>
            <div class="rowContentFlex">
              <p>24h</p>
              <p>Monday - Sunday</p>
            </div>
          </div>
        </div>
        <div class="boxRow">
          <div class="rowContent">
            <h3>Contact</h3>
            <div class="rowContentFlex">
              <p>+43 699 12255185</p>
            </div>
            <div class="rowContentFlex">
              <p>office@codefactory.wien</p>
            </div>
          </div>
          <div class="rowContent">
            <h3>Address</h3>
            <div class="rowContentFlex">
              <p>Kettenbrückengasse 23</p>
            </div>
            <div class="rowContentFlex">
              <p>1050 Wien</p>
            </div>
          </div>
        </div>
      </div>
      <div class="containerBox">
        <div class="containerForm">
          <div class="formHeader">
            <h3>Write us!</h3>
          </div>
          <form action="#"></form>

          <div class="fnlNameInput">
            <div class="">
              <input class="input" placeholder="First Name">
              <p></p>
            </div>
            <div>
              <input class="input" placeholder="Last Name">
              <p></p>
            </div>
          </div>

          <div>
            <input class="input" placeholder="Email">
            <p></p>
          </div>

          <div>
            <textarea class="textInput" placeholder="Message" rows="10"></textarea>
          </div>

          <div class="submitInput">
            <input class="submitBtn" type="submit" name="submit" value="Send">
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>