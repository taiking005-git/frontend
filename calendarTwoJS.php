<?php

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
    <div class="mt-4">
        <div class="calendar__container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="border p-2 form-select-sm w-auto" value="" name="" id="current-date">
                </div>
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
    </div>
    <script src="./calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>