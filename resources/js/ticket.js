window.tiket = {
    vvip: 0,
    vip: 0,
    regular: 0
};

window.harga = {
    vvip: 750000,
    vip: 500000,
    regular: 250000
};

window.tambahTiket = function(type) {

    if (window.tiket[type] !== undefined) {
        window.tiket[type]++;
        updateTiket();
    }

};

window.kurangTiket = function(type) {

    if (window.tiket[type] > 0) {
        window.tiket[type]--;
        updateTiket();
    }

};

function updateTiket() {

    document.getElementById("vvip-count").innerHTML = window.tiket.vvip;
    document.getElementById("vip-count").innerHTML = window.tiket.vip;
    document.getElementById("regular-count").innerHTML = window.tiket.regular;

    document.getElementById("side-vvip").innerHTML = window.tiket.vvip;
    document.getElementById("side-vip").innerHTML = window.tiket.vip;
    document.getElementById("side-regular").innerHTML = window.tiket.regular;

    document.getElementById("price-vvip").innerHTML =
        formatRupiah(window.tiket.vvip * window.harga.vvip);

    document.getElementById("price-vip").innerHTML =
        formatRupiah(window.tiket.vip * window.harga.vip);

    document.getElementById("price-regular").innerHTML =
        formatRupiah(window.tiket.regular * window.harga.regular);

    let total =
        (window.tiket.vvip * window.harga.vvip) +
        (window.tiket.vip * window.harga.vip) +
        (window.tiket.regular * window.harga.regular) +
        5000;

    document.getElementById("total-price").innerHTML =
        formatRupiah(total);

}

function formatRupiah(number) {

    return "Rp " + number.toLocaleString("id-ID");

}