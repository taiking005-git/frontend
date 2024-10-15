<?php
require_once __DIR__ . "/Calendar.php";
$year = 2024;
$month = 10;
$day = 1;

if (!isset($_GET['month'])) {
    $year = "2024";
    $month = "10";
    $day = "01";
} else {
    $year = $_GET['year'];
    $month = $_GET['month'];
}

$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));

$Calendar = new Calendar($date);

// echo $month;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" defer href="calendar.css">
</head>

<body>
    <!-- <?= $date; ?> -->
    <div class="mt-4">
        <!-- <?= $Calendar->renderCalendar() ?> -->
    
        <!-- <div class="calendar__container">
            
             <div class="d-flex justify-content-between align-items-center mb-4">
                <select class="form-select form-select-sm w-auto" value="" name="" id="current-date">
                </select>
                <div class="buttons-icon gap-4 d-flex">
                    <i class="bi bi-chevron-left" id="prev"></i>
                    <i class="bi bi-chevron-right" id="next"></i>
                </div>
            </div>
            <div class="body">
                <ul class="weekdays">
                    <li>S</li>
                    <li>M</li>
                    <li>T</li>
                    <li>W</li>
                    <li>T</li>
                    <li>F</li>
                    <li>S</li>
                </ul>
                <ul class="dates">
                    <button type="button" disabled>1</button><button type="button">2</button><button type="button" class="selected">3</button><button class="" type="button">4</button><button class="" type="button">5</button><button class="" type="button">6</button><button class="" type="button">7</button><button type="button" class="booked">8</button><button type="button" class="today">9</button><button type="button" class="pending">10</button><button class="" type="button">11</button><button class="" type="button">12</button><button class="" type="button">13</button><button class="" type="button">14</button><button class="" type="button">15</button><button class="" type="button">16</button><button class="" type="button">17</button><button class="" type="button">18</button><button class="" type="button">19</button><button class="" type="button">20</button><button class="" type="button">21</button><button class="" type="button">22</button><button class="" type="button">23</button><button class="" type="button">24</button><button class="" type="button">25</button><button class="" type="button">26</button><button class="" type="button">27</button><button class="" type="button">28</button><button class="" type="button">29</button><button class="" type="button">30</button>
                </ul>
            </div> 
            <div class="calendar__info d-flex w-100 justify-content-between align-items-center">
                <div class="fw-bold text-caption d-flex w-100 align-items-center gap-2">
                    <button disabled type="button" class="available text-dark mr-2">10</button>
                    <span> Available</span>
                </div>
                <div class="fw-bold text-caption d-flex w-100 align-items-center gap-2 ">
                    <button disabled type="button" class="pending">10</button>
                    <span> Pending</span>
                </div>
                <div class="fw-bold text-caption d-flex w-100 align-items-center gap-2">
                    <button disabled type="button" class="booked">10</button>
                    <span> Booked</span>
                </div>
            </div>
        </div>
        <label for="agreement" class="form-label mt-2">
            <input type="checkbox" required name="agreement" class="form-check-input" id="fullday" value="booking-type" />
            <small class="text-body-2">
                I acknowledge that I have read and agree to <a href="#">Terms and Condition</a> and <a href="#">Privacy
                    Policy.</a>
            </small>
        </label>
    </div> -->
        <!-- <script src="./calendar.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
</body>

</html>

<!-- <script>
    const btnEl = document.querySelectorAll(".buttons-icon i");

    btnEl.forEach((btn) => {
        btn.addEventListener("click", () => {
            console.log("button clicked");
        })
    })
</script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Call a function to update the calendar display with the new month and year
        // updateCalendar(activeMonth, activeYear);

        // Handle the click event for the previous button
        $('#prev').click(function() {
            activeMonth--;

            if (activeMonth < 1) {
                activeMonth = 12;
                activeYear--;
            }
            console.log(activeMonth);

            // Call a function to update the calendar display with the new month and year
            updateCalendar(activeMonth, activeYear);
        });

        // Handle the click event for the next button
        $('#next').click(function() {
            activeMonth++;

            if (activeMonth > 12) {
                activeMonth = 1;
                activeYear++;
            }
            console.log(activeMonth);

            // Call a function to update the calendar display with the new month and year
            updateCalendar(activeMonth, activeYear);
        });

        // Function to update the calendar (you'll have to implement this on the server-side)
        function updateCalendar(month, year) {
            // This part depends on how you're generating the calendar (possibly with PHP).
            // You might need to make an AJAX request to fetch the new calendar data
            // and then update the DOM with the new HTML.
            $.ajax({
                type: 'GET',
                url: 'CalendarTwoFunction.php', // Your server-side endpoint
                data: {
                    month: activeMonth,
                    year: activeYear
                },
                success: function(response) {
                    // Update the calendar container with the new HTML returned by the server
                    $('.calendar__container').html(response);
                    // console.log(response);
                },
                error: function(error) {
                    console.log("Error updating the calendar:", error);
                },
            });
        }
    });
</script>