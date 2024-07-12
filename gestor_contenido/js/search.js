// search.js

document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.getElementById('search-icon');
    const searchModal = document.getElementById('search-modal');
    const closeBtn = document.getElementsByClassName('close-btn')[0];

    searchIcon.addEventListener('click', function() {
        searchModal.style.display = 'block';
    });

    closeBtn.addEventListener('click', function() {
        searchModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === searchModal) {
            searchModal.style.display = 'none';
        }
    });

    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');

    searchBtn.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query) {
            // Implementar la búsqueda aquí
            console.log('Buscar:', query);
            // Puedes redirigir a una página de resultados o mostrar resultados en el modal
        }
    });
});
