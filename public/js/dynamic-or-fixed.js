const dynamic = document.getElementById('dynamic')
const fixed = document.getElementById('fixed')
const inputCheck = document.getElementById('input-check')
const desc = document.getElementById('plan-desc');
const errorMsg = document.getElementById('error-booking-message');



const messageDynamic = "Dynamic bookings allow you to offer flexible check-in and check-out options to meet the diverse needs of travelers. This option is perfect for properties that cater to spontaneous guests or have varying availability."
const messageFixed = "Fixed bookings provide guests with predefined check-in and check-out dates, ideal for properties offering specific packages, seasonal promotions, or event-driven stays. Set your dates and let us handle the rest!<br> NOTE: You need to renew another date after check-in date has passed."

dynamic.addEventListener('click', () => {
    dynamic.checked = true
    fixed.checked = false
    inputCheck.style = ""

    desc.innerText = messageDynamic

});


fixed.addEventListener('click', () => {
    dynamic.checked = false
    fixed.checked = true
    inputCheck.style = "max-height: 5rem; border: 1px solid rgb(209 213 219 / var(--tw-border-opacity, 1));"

    let str = "";
    let files = document.querySelectorAll(".files");
    files.forEach(element => {
        str += + element.getAttribute('src'); + "-" 
    });
    inputFiles.value = str;
    console.log(str)

    desc.innerHTML = messageFixed
});

const inputFiles = document.getElementById('files-result');
const propertyErrorMsg = document.getElementById('property-error-msg');
function CheckDynamicOrFixedCheckbox(params) {
    let a = false;

    if (combobox !== null && combobox.value == "Property") {
        propertyErrorMsg.classList.remove('hidden')
        a = true;
    } else propertyErrorMsg.classList.add('hidden');

    if (dynamic !== null && !dynamic.checked === true || fixed !== null && !fixed.checked === true) {
        errorMsg.classList.remove('hidden')
        a = true;
    } else errorMsg.classList.add('hidden');

    if (a) return false;


    errorMsg.classList.add('hidden')

    return true;
}

const combobox = document.getElementById('property-combobox');
