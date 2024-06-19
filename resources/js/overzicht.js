
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
// Sluit de success alert na 5 seconden
setTimeout(function() {
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
        successAlert.remove();
    }
}, 5000); // 5000 milliseconden = 5 seconden

// Sluit de error alert na 5 seconden
setTimeout(function() {
    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        errorAlert.remove();
    }
}, 5000); // 5000 milliseconden = 5 seconden