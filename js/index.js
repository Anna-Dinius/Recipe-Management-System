$(document).ready(function() {
    var offset = 0;
    var currentFilter = "All";

    // Toggling filter dropdown menu

    $(".dropdown-toggle").on("click", function() {
        $(this).next(".dropdown-menu").toggle();
    });

    $(".dropdown-item").on("click", function() {
        offset = 0;
        $("#load-more").removeClass("hide");
        currentFilter = $(this).text();
        $("#content").empty();
        // displayCards();
        let dropdown = $(this).closest(".dropdown").find(".dropdown-menu");
        dropdown.toggle(); // Hiding dropdown menu

        $("#dropdownMenu2").text($(this).text());
        $(".dropdown-item").prop("disabled", false);
        $(this).prop("disabled", true);
    });
});
