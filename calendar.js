const currentDateEl = document.getElementById("current-date");
const datesEl = document.querySelector(".dates");
const prevNextButton = document.querySelectorAll(".buttons-icon i");
const dateButtonsEl = document.querySelectorAll(".dates button");


const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
const events = [];
let selectedDateArray = [];

// flexible date selection
events.push(["BookingID", ["2024-9-1", "2024-9-2", "2024-9-3"], "booked"])
events.push(["BookingID", ["2024-10-1", "2024-10-2", "2024-10-3"], "pending"])
events.push(["BookingID", ["2024-10-10", "2024-10-11", "2024-10-12"], "booked"])


let date = new Date(),
    currentYear = date.getFullYear(),
    currentMonth = date.getMonth();

const updateYearMonth = () => {
    currentMonth = currentMonth;
}

const handleDateClick = (e) => {
    const button = e.target;

    if (button.disabled) {
        return; // Exit if the button is disabled
    }

    const dateStr = `${currentYear}-${currentMonth + 1}-${parseInt(button.textContent)}`;

    // Check if date is in selectedDateArray
    const dateIndex = selectedDateArray.indexOf(dateStr);

    if (dateIndex !== -1) {
        // If date is found, remove it and unselect the button
        selectedDateArray.splice(dateIndex, 1);
        button.classList.remove("selected");
    } else {
        // If date is not found, add it and select the button
        selectedDateArray.push(dateStr);
        button.classList.add("selected");
    }

    console.log(selectedDateArray);

};


const renderCalender = () => {
    //clear the options
    currentDateEl.innerHTML = ""; // update the year and month

    // clear the dates
    datesEl.innerHTML = "";

    let firstDayofMonth = new Date(currentYear, currentMonth, 1).getDay(); //getting first day of month
    let lastDateofMonth = new Date(currentYear, currentMonth + 1, 0).getDate(); //getting last date of month
    let lastDayofMonth = new Date(currentYear, currentMonth, lastDateofMonth).getDay(); //getting last date of month
    let lastDayofLastMonth = new Date(currentYear, currentMonth, 0).getDate(); //getting last day of previous month

    // * display the last week of previous month
    for (let i = firstDayofMonth; i > 0; i--) {
        const button = createBtn(lastDayofLastMonth - i + 1, true);
        datesEl.appendChild(button);
    }


    // * display the current month
    for (let i = 1; i <= lastDateofMonth; i++) {

        //add status in the event array to the bookingstatus
        let bookingStatus = "available";
        let disable = false;

        events.forEach((ev, index) => {
            ev[1].forEach(date => {
                if (date === `${currentYear}-${currentMonth + 1}-${i}`) {
                    bookingStatus = events[index][2];
                    disable = true;
                }
            })
        })

        // disable date that is less than current date
        if (new Date(currentYear, currentMonth, i + 1) <= new Date()) {
            disable = true;
        }


        //check if the date is in the selectedDateArray
        const isSelected = selectedDateArray.includes(`${currentYear}-${currentMonth + 1}-${i}`);
        if (isSelected) {
            bookingStatus = "selected";
        }


        const button = createBtn(i, disable, bookingStatus);
        button.addEventListener("click", handleDateClick);
        datesEl.appendChild(button);
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        const button = createBtn(i - lastDayofMonth + 1, true);
        datesEl.appendChild(button);
    }

    currentDateEl.innerHTML = `${months[currentMonth]} ${currentYear}`;
}



const createBtn = (text, isDisabled = false, status = "available") => {

    const currentDate = new Date();

    // check if the current button is the current date
    const isToday = currentDate.getDate() === text &&
        currentDate.getMonth() === currentMonth &&
        currentDate.getFullYear() === currentYear;

    const button = document.createElement('button');
    button.textContent = text;
    button.disabled = isDisabled;
    button.classList.toggle("today", isToday);
    button.classList.add(status);
    return button;
}

renderCalender();


prevNextButton.forEach((btn) => {
    btn.addEventListener("click", () => {

        btn.id === "prev" ? currentMonth-- : currentMonth++;

        if (currentMonth < 0 || currentMonth > 11) {
            date = new Date(currentYear, currentMonth);
            currentYear = date.getFullYear();
            currentMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalender();
    })
})
