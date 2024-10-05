/*------- FORM LOGIC -------------------------------------------------------------------------- */
$(document).on("click", ".del-input", function() {
    $(this).closest("div").remove();
});

$(document).on("click", "#add-ingredient", function() {
    let name = $(".ingredient-input").length + 1;
    $("#m-ingredients").append(
        `<div class="d-flex">
			<input class="form-control mb-3 ingredient-input" id="ingredient-${name}"/>
			<button class="btn btn-danger del-input">X</button>
		</div>`,
    );
});

$(document).on("click", "#add-step", function() {
    let name = $(".step-input").length + 1;
    $("#m-steps").append(
        `<div class="d-flex">
			<textarea class="form-control textarea mb-3 step-input" id="step-${name}"></textarea>
			<button class="btn btn-danger del-input">X</button>
		</div>`,
    );
});

export function clearForm() {
    $("#change-form").trigger("reset");
    $("#m-ingredients").empty();
    $("#m-steps").empty();
    $("#ingredients").empty();
    $("#steps").empty();
}

var prepHrs = 0;
var prepMins = 0;
var cookHrs = 0;
var cookMins = 0;

$(document).on('change', '.prep_time.time_hrs', function() {
    prepHrs = parseInt($(this).val());
    updateTotalTime();
});

$(document).on('change', '.prep_time.time_mins', function() {
    prepMins = parseInt($(this).val());
    updateTotalTime();
});

$(document).on('change', '.cook_time.time_hrs', function() {
    cookHrs = parseInt($(this).val());
    updateTotalTime();
});

$(document).on('change', '.cook_time.time_mins', function() {
    cookMins = parseInt($(this).val());
    updateTotalTime();
});

export function updateTotalTime() {
    var totalHrs = prepHrs + cookHrs;
    var totalMins = prepMins + cookMins;

    if (totalMins >= 60) {
        totalMins -= 60;
        totalHrs++;
    }

    var hours = "hours";
    var minutes = "minutes";

    if (totalHrs == 1) {
        hours = "hour";
    }

    var totalTimeString = totalHrs + " " + hours + ", " + totalMins + " " + minutes;

    document.getElementById('m-total-time').value = totalTimeString;
}

var prep_time_hours;
var prep_time_minutes;
var cook_time_hours;
var cook_time_minutes;

function updateTime(){
	if (prep_time_hours === null || prep_time_hours === undefined){
		prep_time_hours = 0;
	}
	if (prep_time_minutes === null || prep_time_minutes === undefined){
		prep_time_minutes = 0;
	}
	if (cook_time_hours === null || cook_time_hours === undefined){
		cook_time_hours = 0;
	}
	if (cook_time_minutes === null || cook_time_minutes === undefined){
		cook_time_minutes = 0;
	}
}

// Save logic
$(document).on("click", "#save-changes-btn", function() {
    const name = $('#recipe-name').val();
    const author = $('#m-authorName').val();
    const category = $('#m-category').find("option:selected").text();
	
	prep_time_hours = parseInt($('#prep_time_hrs').find("option:selected").text());
    prep_time_minutes = parseInt($('#prep_time_mins').find("option:selected").text());
	
	let hours = "hours";
	if (prep_time_hours == 1) { hours = "hour"; }
	const prep_time = prep_time_hours + " " + hours + ", " + prep_time_minutes + " minutes";
	
    cook_time_hours = parseInt($('#cook_time_hrs').find("option:selected").text());
    cook_time_minutes = parseInt($('#cook_time_mins').find("option:selected").text());
	
	updateTime();
	
	hours = "hours";
	if (cook_time_hours == 1) { hours = "hour"; }
	const cook_time = cook_time_hours + " " + hours + ", " + cook_time_minutes + " minutes";
	
    const total_time = $('#m-total-time').val();
    const serving_sizes = parseInt($('#servingSizes').find("option:selected").text());
    const img_url = $('input[name="image"]').val();
    const ingredient = $('#ingredient-1').val();
    const step = $('#step-1').val();

    const invalid_name = (name === "" || name === undefined);
    const invalid_prep_time = ((prep_time_hours == 0 && prep_time_minutes == 0) || prep_time_hours === undefined || prep_time_minutes === undefined);
    const invalid_serving_sizes = (serving_sizes == 0 || serving_sizes === undefined);
    const invalid_ingredient = (ingredient === "" || ingredient === undefined);
    const invalid_step = (step === "" || step === undefined);

    if (invalid_name || invalid_prep_time || invalid_serving_sizes || invalid_ingredient || invalid_step) {
        var message = "";

        if (invalid_name) { message += "\n  Recipe name"; }
        if (invalid_prep_time) { message += "\n  Prep time"; }
        if (invalid_serving_sizes) { message += "\n  Serving size"; }
        if (invalid_ingredient) { message += "\n  Ingredient(s)"; }
        if (invalid_step) { message += "\n  Step(s)"; }

        alert("The following fields are required:" + message);
    }
})