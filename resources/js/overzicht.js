
document.getElementById('FilterButton').onclick = function() {
    var filters = document.getElementById("Filters");
    filters.style.display = (filters.style.display === "block") ? "none" : "block";
}
document.getElementById('FilterButton2').onclick = function() {
    var filters = document.getElementById("Filters");
    filters.style.display = "none";
}
document.querySelectorAll('.PinKnop').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        fetch('/kandidaat/' + id + '/pin', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                window.location.href = '/overzicht';
            } else {
                console.error('Er is een fout opgetreden bij het pinnen van de kandidaat');
            }
        }).catch(error => {
            console.error('Er is een fout opgetreden bij het pinnen van de kandidaat:', error);
        });
    });
});