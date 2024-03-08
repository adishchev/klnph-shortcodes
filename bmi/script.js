
const height = document.querySelector("input[name='height']");
const weight = document.querySelector("input[name='weight']");

height.addEventListener("keyup",   bmi_calculator, false);
weight.addEventListener("keyup",   bmi_calculator, false);
weight.addEventListener("keydown", bmi_validator, false);

bmi_range_init();
bmi_calculator();

function bmi_range_init() {
    const regions = document.querySelectorAll('.bmi__chart .bmi__range');
    let prev = total = 0;
    regions.forEach( (item) => {
        total = bmiGetRangeValue(item.dataset.bmi)
        item.style.width = total - prev + '%';
        prev = total
        console.log(item.dataset.bmi);
        console.log('value = ' + item.style.width);
    });
}

function bmi_calculator (event) {
    const height = document.querySelector("input[name='height']").value / 100;
    const weight = document.querySelector("input[name='weight']").value;
    const marker = document.querySelector(".bmi__marker");
    const value = document.querySelector(".bmi__value");

    if (height && weight) {
        const bmi = Math.round((weight / height / height) * 10) / 10;
        value.textContent = bmi;
        let markerPadding = bmiGetRangeValue(bmi);
        marker.style.paddingLeft = `calc(${markerPadding}% - 10px)`;
        // marker.hidden = false;
        console.log( markerPadding );
    } else {
        value.textContent = '…';
        // marker.hidden = true;
    }
}

function bmi_validator(event) {
    const key = event.key;
    const allowed = ['ArrowLeft', 'ArrowRight', 'Backspace', 'Delete'];
    if (! (allowed.includes(key) || "0123456789.".includes(key) || event.ctrlKey) ) {
       event.preventDefault();
    }
}
function bmiGetRangeValue(bmi) {
    let categories = [15, 18.5, 25, 30, 35];

    let range = categories[categories.length - 1] - categories[0];
    let value = 100 * (bmi - categories[0]) / range;
    if (value < 0) {
        value = 0;
    } else if (value > 100) {
        value = 100;
    }
    return Math.round(value * 100) / 100;
}

