document.addEventListener('keydown', function(e) {
    if (e.target.type === 'number') {
        if (['e', 'E', '+', '-'].includes(e.key)) {
            e.preventDefault();
        }
    }
});
