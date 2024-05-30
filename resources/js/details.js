// resources/js/details.js

document.getElementById('deelKandidaatKnop').onclick = function() {
    navigator.clipboard.writeText(window.location.href) // Kopieer URL naar klembord
    .then(() => {
        alert('Kandidaat gekopieerd naar klembord: ' + window.location.href); // Succesbericht
    })
    .catch(err => {
        console.error('Kopiëren is mislukt, probeer later opnieuw'); // Foutbericht
    });
};

document.getElementById('deleteButton').addEventListener('click', function() {
    var confirmation = confirm('Weet u zeker dat u deze kandidaat wilt verwijderen?');
    if (confirmation) {
        var id = window.location.href.split('/').pop();
        fetch('/kandidaat/' + id + '/delete', { // hoe werkt dit precies?
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                //navigate to the overview page
                window.location.href = '/overzicht';
            } else {
                // Er is iets misgegaan
                console.error('Er is een fout opgetreden bij het verwijderen van de kandidaat');
            }
        }).catch(error => {
            console.error('Er is een fout opgetreden bij het verwijderen van de kandidaat:', error);
        });
    }
});

document.querySelectorAll('.deleteReferentie').forEach(button => {
    button.addEventListener('click', function() {
        var confirmation = confirm('Weet u zeker dat u deze referentie wilt verwijderen?');
        if (confirmation) {
            var reviewId = this.dataset.reviewId;
            fetch('/review/' + reviewId + '/deleteReview', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    // Refresh the page or remove the review element from the DOM
                    window.location.reload();
                } else {
                    // Er is iets misgegaan
                    console.error('Er is een fout opgetreden bij het verwijderen van de referentie');
                }
            }).catch(error => {
                console.error('Er is een fout opgetreden bij het verwijderen van de referentie:', error);
            });
        }
    });
});

document.getElementById('PinKnop').addEventListener('click', function() {
    var id = window.location.href.split('/').pop();
    fetch('/kandidaat/' + id + '/pin', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.ok) {
            //navigate to the overview page
           window.location.href = '/overzicht';
        } else {
            // Er is iets misgegaan
            console.error('Er is een fout opgetreden bij het pinnen van de kandidaat');
        }
    }).catch(error => {
        console.error('Er is een fout opgetreden bij het pinnen van de kandidaat:', error);
    });
});
