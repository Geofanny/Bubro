document.getElementById('price').addEventListener('input', (event) => {
    const input = event.target.value;
    // Hanya mengizinkan angka dari 1 hingga 9
    const validPattern = /^[1-9]*$/;

    if (!validPattern.test(input)) {
        // Menghapus karakter yang tidak valid dari input
        event.target.value = input.replace(/[^1-9]/g, '');
    }
});

document.getElementById('stock').addEventListener('input', (event) => {
    const input = event.target.value;
    // Hanya mengizinkan angka dari 1 hingga 9
    const validPattern = /^[1-9]*$/;

    if (!validPattern.test(input)) {
        // Menghapus karakter yang tidak valid dari input
        event.target.value = input.replace(/[^1-9]/g, '');
    }
});