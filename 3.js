function cetakGambar(n) {

    if (n % 2 == 0) return null;
    var cetak = '';
    for (var x = 0; x < n; x++) {
        for (var y = 0; y < n; y++) {
            if (((x + 1) % 2 == 1) || (y == 0 || y == n - 1)) {
                cetak += ' * ';
            } else {
                cetak += ' = ';
            }
        }
        console.log(cetak);
        cetak = '';
    }
}

cetakGambar(7);
