<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
  header("Location: ../login/login.php");
}

require_once "db_connection.php";
require_once "navbar.php";

$data = "";
$sql = "SELECT * FROM `courses`";

$result = mysqli_query($connection, $sql);




?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      let data = [];
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,

        Boolean,
        default: true,


        events: [
          <?php while ($rows = mysqli_fetch_assoc($result)) { ?> {
              id: "<?= $rows["id"] ?>",
              title: "<?= $rows['name'] ?>",
              start: "<?= $rows["date"] ?>",
              end: "<?= $rows["end_date"] ?>",
            },
          <?php } ?>

        ],

        dateClick: function(info) {
          if (info.dayEl.style.backgroundColor === 'green') {
            info.dayEl.style.backgroundColor = 'red';
          } else {
            info.dayEl.style.backgroundColor = 'green';
          }
        },
        eventColor: '#0ca678',
        eventBackgroundColor: '#0ca678', // Standardfarbe für Ereignisse
        eventBorderColor: 'green', // Standardfarbe für Ereignisrahmen
      });
      calendar.render();
    });
  </script>
  <style>
    .boxCalendar {
      margin-top: 10px;
      display: flex;
      justify-content: center;
    }

    #calendar {
      width: 80%;
    }

    a.fc-col-header-cell-cushion {
      text-decoration: none;
      color: #565656;
    }

    a.fc-daygrid-day-number {
      text-decoration: none;
      color: #565656;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/index.css">
</head>

<body>
  <div class="boxCalendar">
    <div id='calendar'></div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>