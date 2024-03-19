document.querySelector("input[name='height']").addEventListener("keyup",   bmi_calculator, false);
document.querySelector("input[name='height']").addEventListener("keydown", bmi_validator, false);
document.querySelector("input[name='weight']").addEventListener("keyup",   bmi_calculator, false);
document.querySelector("input[name='weight']").addEventListener("keydown", bmi_validator, false);

let bmiChart = [];

bmi_range_init();

function bmi_range_init() {
    const regions = document.querySelectorAll('.bmi__chart .bmi__range');

    // Range
    let prev = total = 0;
    const first = regions[0].dataset.bmi;
    const last  = regions[regions.length-1].dataset.bmi
    regions.forEach( (item) => {
        bmiChart.push({
            limit: item.dataset.bmi,
            title: item.dataset.title
        });
        total = bmiGetRangeValue(item.dataset.bmi, first, last)
        item.style.width = total - prev + '%';
        prev = total;
    });

    bmi_calculator();
}

function bmi_calculator (event) {
    let bmi;
    const height = document.querySelector("input[name='height']").value / 100;
    const weight = document.querySelector("input[name='weight']").value;

    if (height && weight) {
        bmi = Math.round((weight / height / height) * 10) / 10;
    }

    return bmiShowResult(bmi);
}

function bmi_validator(event) {
    const key = event.key;
    const allowed = ['ArrowLeft', 'ArrowRight', 'Backspace', 'Delete'];
    if (! (allowed.includes(key) || "0123456789.".includes(key) || event.ctrlKey) ) {
       event.preventDefault();
    }
}
function bmiGetRangeValue(current, first, last) {
    let range = last - first;
    let scale = 100 * (current - first) / range;
    if (scale < 0) {
        scale = 0;
    } else if (scale > 100) {
        scale = 100;
    }
    return Math.round(scale * 100) / 100;
}

function bmiShowResult(bmi) {
    const marker = document.querySelector(".bmi__marker");
    const result = document.querySelector(".bmi__result-value");
    const title  = document.querySelector(".bmi__result-info");
    
    console.log(bmi);
    if (bmi != undefined && bmi > 0) {
        result.textContent = bmi;
        let bmiRangeTitle;
        for (const item of bmiChart) {
            bmiRangeTitle = item.title;
            if (bmi < item.limit) {
                break;
            }
        }
        title.textContent  = bmiRangeTitle;
        
        let markerPadding = bmiGetRangeValue(bmi, bmiChart[0].limit, bmiChart[bmiChart.length-1].limit);
        marker.style.paddingLeft = `calc(${markerPadding}% - 10px)`;

        result.style.visibility = 'visible';
        title.style.visibility  = 'visible';
        marker.style.visibility = 'visible';
    } else {
        result.style.visibility = 'hidden';
        title.style.visibility  = 'hidden';
        marker.style.visibility = 'hidden';
    }
}

