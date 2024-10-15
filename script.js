const dates = document.querySelector(".dates");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");
const monthInput = document.querySelector(".month-input");
const yearInput = document.querySelector(".year-input");
const applyBtn = document.querySelector(".apply")
const selected = document.querySelector(".selected")


let selectedDate = new Date();
let year = selectedDate.getFullYear();
let month = selectedDate.getMonth();


// selected.value = selectedDate;

applyBtn.addEventListener("click", () => {
    selected.textContent = selectedDate.toLocaleDateString("en-US", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });
})


prevBtn.addEventListener("click", () => {
    if (month === 0) year--;
    month = (month - 1 + 12) % 12
    displayDates();
})

nextBtn.addEventListener("click", () => {
    if (month === 11) year++;
    month = (month + 1) % 12;
    displayDates();
})

// handle month change from input
monthInput.addEventListener("change", () => {
    month = monthInput.selectedIndex;
    displayDates();
})
// handle year change from input
yearInput.addEventListener("change", () => {
    year = yearInput.value;
    displayDates();
})



const updateYearMonth = () => {
    yearInput.value = year;
    monthInput.selectedIndex = month;
}


const handleDateClick = (e) => {
    const button = e.target;

    // remove selected from other
    const selected = dates.querySelector('.selected');
    selected && selected.classList.remove("selected");

    // add the selected class to the current button
    button.classList.add("selected");

    // set the selected date
    selectedDate = new Date(year, month, parseInt(button.textContent));
}


// render the dates in the calendar
const displayDates = () => {

    // update the year and month
    updateYearMonth();

    // clear the dates
    dates.innerHTML = "";

    // * display the last week of previous month
    // get the last date of the previous month
    const lastDayOfPrevMonth = new Date(year, month, 0);

    for (let i = 0; i <= lastDayOfPrevMonth.getDay(); i++) {
        const text = lastDayOfPrevMonth.getDate() - lastDayOfPrevMonth.getDay() + i;
        const button = createBtn(text, true);
        dates.appendChild(button);
    }

    // * display the current month
    // get the last day of the month
    const lastDayOfMonth = new Date(year, month + 1, 0);

    for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
        const button = createBtn(i, false);
        button.addEventListener("click", handleDateClick);
        dates.appendChild(button);
    }


    // * display the first week of the next month
    // get the first day of next month 
    const firstDayOfNextMonth = new Date(year, month + 1, 1)

    for (let i = firstDayOfNextMonth.getDay(); i < 7; i++) {
        const text = firstDayOfNextMonth.getDate() - firstDayOfNextMonth.getDay() + i;
        const button = createBtn(text, true);
        dates.appendChild(button);

    }


};

const createBtn = (text, isDisabled = false) => {

    const currentDate = new Date();

    // check if the current button is the current date
    const isToday = currentDate.getDate() === text &&
        currentDate.getMonth() === month &&
        currentDate.getFullYear() === year;
    
    // check if the current button is the current date
    // const selected = selectedDate.getDate() === text &&
    //     selectedDate.getMonth() === month &&
    //     selectedDate.getFullYear() === year;

    const button = document.createElement('button');
    button.textContent = text;
    button.disabled = isDisabled;
    button.classList.toggle("today", isToday);
    // button.classList.toggle("selected", selected);
    return button;
}

displayDates();


