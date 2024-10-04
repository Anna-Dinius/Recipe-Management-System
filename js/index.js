$(document).ready(function() {
    var apiUrl = "http://localhost:3000/api/recipes";
    var offset = 0;
    var rpp = 9;
    var currentFilter = "All";

    // creates serving size options
    let largestServing = 20;
    for (let i = 1; i <= largestServing; i++) {
        $("#servings").append(`<option value="${i}">${i}</option>`);
    }

    // Create card function

    function createCard(index, recipes) {
        if (offset + rpp + 1 > recipes.length) {
            $("#load-more").addClass("hide");
        }
    }

    // Displaying the recipe cards with GET request

    var recipes;
    var fullRecipes;
    function displayCards(contentCleared = false) {
        $.get(apiUrl, function(data) {
            fullRecipes = data.data;
            recipes = fullRecipes;
            let filteredRecipes = [];
            if (currentFilter !== "All") {
                for (let i = 0; i < fullRecipes.length; i++) {
                    if (fullRecipes[i].category === currentFilter) {
                        filteredRecipes.push(fullRecipes[i]);
                    }
                }
                recipes = filteredRecipes;
            }
            for (
                let i = contentCleared ? 0 : offset;
                i < Math.min(offset + rpp, recipes.length);
                i++
            ) {
                createCard(i, recipes);
            }
        }).fail(function() { });
    }

    displayCards();

    // Toggling filter dropdown menu

    $(".dropdown-toggle").on("click", function() {
        $(this).next(".dropdown-menu").toggle();
    });

    $(".dropdown-item").on("click", function() {
        offset = 0;
        $("#load-more").removeClass("hide");
        currentFilter = $(this).text();
        $("#content").empty();
        displayCards();
        let dropdown = $(this).closest(".dropdown").find(".dropdown-menu");
        dropdown.toggle(); // Hiding dropdown menu

        $("#dropdownMenu2").text($(this).text());
        $(".dropdown-item").prop("disabled", false);
        $(this).prop("disabled", true);
    });

    // Modal logic
    $(document).on("click", ".del-input", function() {
        $(this).closest("div").remove();
    });

    $(document).on("click", "#add-ingredient", function() {
        let name = $(".ingredient-input").length + 1;
        $("#ingredients").append(
            `<div class="d-flex">
				<input class="form-control mb-3 ingredient-input" name="ingredient-${name}"/>
				<button class="btn btn-danger del-input">X</button>
			</div>`,
        );
    });

    $(document).on("click", "#add-step", function() {
        let name = $(".step-input").length + 1;
        $("#steps").append(
            `<div class="d-flex">
				<textarea class="form-control textarea mb-3 step-input" name="step-${name}"></textarea>
				<button class="btn btn-danger del-input">X</button>
			</div>`,
        );
    });
});
