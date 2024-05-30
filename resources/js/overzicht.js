
document.getElementById('FilterButton').onclick = function() {
    var filters = document.getElementById("Filters");
    filters.style.display = (filters.style.display === "block") ? "none" : "block";
}
document.getElementById('FilterButton2').onclick = function() {
    var filters = document.getElementById("Filters");
    filters.style.display = "none";
}