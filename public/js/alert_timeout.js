setTimeout(function() {
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 300); // Видалення з DOM після анімації
    });
}, 3000); // 5000 мс = 3 секунд
