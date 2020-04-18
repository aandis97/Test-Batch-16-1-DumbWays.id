function hitungKembalian(totalBelanja, uang) {
    var uangKembalian = ['50000', '20000', '10000', '5000'];
    var cashBack = 0;
    var kembalian = uang - totalBelanja;

    if (totalBelanja > 200000) {
        cashBack = totalBelanja * 0.1;
    }
    kembalian += cashBack;
    console.log(kembalian);

    var jumlah = 0;
    for (var i = 0; i < uangKembalian.length; i++) {
        jumlah = Math.floor(kembalian / uangKembalian[i]);
        kembalian = kembalian % uangKembalian[i];
        if (jumlah != 0)
            console.log(jumlah + ' x ' + uangKembalian[i]);
    }

    if (kembalian != 0)
        console.log(kembalian + " Disumbangkan karena tidak ada kembalian dibawah 5000");
}

hitungKembalian(220000, 263000);