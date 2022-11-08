//Create references to the dropdown's USER REGISTER
const yearSelect = document.getElementById("year");
const monthSelect = document.getElementById("month");
const daySelect = document.getElementById("day");

const months = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 
'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม',
'พฤศจิกายน', 'ธันวาคม'];

//Months are always the same
(function populateMonths(){
    for(let i = 0; i < months.length; i++){
        const option = document.createElement('option');
        option.textContent = months[i];
        monthSelect.appendChild(option);
    }
    monthSelect.value = "มกราคม";
})();

let previousDay;

function populateDays(month){
    //Delete all of the children of the day dropdown
    //if they do exist
    while(daySelect.firstChild){
        daySelect.removeChild(daySelect.firstChild);
    }
    //Holds the number of days in the month
    let dayNum;
    //Get the current year
    let year = yearSelect.value;

    if(month === 'มกราคม' || month === 'มีนาคม' || 
    month === 'พฤษภาคม' || month === 'กรกฎาคม' || month === 'สิงหาคม' 
    || month === 'ตุลาคม' || month === 'ธันวาคม') {
        dayNum = 31;
    } else if(month === 'เมษายน' || month === 'มิถุนายน' 
    || month === 'กันยายน' || month === 'พฤศจิกายน') {
        dayNum = 30;
    }else{
        //Check for a leap year
        if(new Date(year, 1, 29).getMonth() === 1){
            dayNum = 29;
        }else{
            dayNum = 28;
        }
    }
    //Insert the correct days into the day <select>
    for(let i = 1; i <= dayNum; i++){
        const option = document.createElement("option");
        option.textContent = i;
        daySelect.appendChild(option);
    }
    if(previousDay){
        daySelect.value = previousDay;
        if(daySelect.value === ""){
            daySelect.value = previousDay - 1;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 2;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 3;
        }
    }
}

function populateYears(){
    //Get the current year as a number
    let year = new Date().getFullYear();
    //Make the previous 100 years be an option
    for(let i = 0; i < 101; i++){
        const option = document.createElement("option");
        option.textContent = year - i;
        yearSelect.appendChild(option);
    }
}

populateDays(monthSelect.value);
populateYears();

yearSelect.onchange = function() {
    populateDays(monthSelect.value);
}
monthSelect.onchange = function() {
    populateDays(monthSelect.value);
}
daySelect.onchange = function() {
    previousDay = daySelect.value;
}







//Create references to the dropdown's CLEANER REGISTER
const yearSelect1 = document.getElementById("yearC");
const monthSelect1 = document.getElementById("monthC");
const daySelect1 = document.getElementById("dayC");


//Months are always the same
(function populateMonths1(){
    for(let i = 0; i < months.length; i++){
        const option = document.createElement('option');
        option.textContent = months[i];
        monthSelect1.appendChild(option);
    }
    monthSelect1.value = "มกราคม";
})();

let previousDay1;

function populateDays1(month){
    //Delete all of the children of the day dropdown
    //if they do exist
    while(daySelect1.firstChild){
        daySelect1.removeChild(daySelect1.firstChild);
    }
    //Holds the number of days in the month
    let dayNum;
    //Get the current year
    let year = yearSelect1.value;

    if(month === 'มกราคม' || month === 'มีนาคม' || 
    month === 'พฤษภาคม' || month === 'กรกฎาคม' || month === 'สิงหาคม' 
    || month === 'ตุลาคม' || month === 'ธันวาคม') {
        dayNum = 31;
    } else if(month === 'เมษายน' || month === 'มิถุนายน' 
    || month === 'กันยายน' || month === 'พฤศจิกายน') {
        dayNum = 30;
    }else{
        //Check for a leap year
        if(new Date(year, 1, 29).getMonth() === 1){
            dayNum = 29;
        }else{
            dayNum = 28;
        }
    }
    //Insert the correct days into the day <select>
    for(let i = 1; i <= dayNum; i++){
        const option = document.createElement("option");
        option.textContent = i;
        daySelect1.appendChild(option);
    }
    if(previousDay1){
        daySelect1.value = previousDay1;
        if(daySelect1.value === ""){
            daySelect1.value = previousDay1 - 1;
        }
        if(daySelect1.value === ""){
            daySelect1.value = previousDay1 - 2;
        }
        if(daySelect1.value === ""){
            daySelect1.value = previousDay1 - 3;
        }
    }
}

function populateYears1(){
    //Get the current year as a number
    let year = new Date().getFullYear();
    //Make the previous 100 years be an option
    for(let i = 0; i < 101; i++){
        const option = document.createElement("option");
        option.textContent = year - i;
        yearSelect1.appendChild(option);
    }
}

populateDays1(monthSelect1.value);
populateYears1();

yearSelect1.onchange = function() {
    populateDays1(monthSelect1.value);
}
monthSelect1.onchange = function() {
    populateDays1(monthSelect1.value);
}
daySelect1.onchange = function() {
    previousDay1 = daySelect1.value;
}