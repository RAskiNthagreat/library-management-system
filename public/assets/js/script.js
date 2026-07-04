console.log("script.js loaded");
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("search");
    const resultsTable = document.getElementById("book-results");

    // Exiting if we're not on the search page
    if (!searchInput || !resultsTable) {
        return;
    }

    searchInput.addEventListener("keyup", function () {

        const searchText = searchInput.value;

        fetch("search_api.php?search=" + encodeURIComponent(searchText))
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                resultsTable.innerHTML = data;
            })
            .catch(function (error) {
                console.error("Search error:", error);
            });

    });

});