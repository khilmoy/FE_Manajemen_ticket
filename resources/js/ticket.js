let tiket = {
    vvip: 0,
    vip: 0,
    regular: 0
};

const harga = {
    vvip: 750000,
    vip: 500000,
    regular: 250000
};


window.tambahTiket = function(type) {

    if (tiket[type] !== undefined) {
        tiket[type]++;
        updateTiket();
    }

};


window.kurangTiket = function(type) {

    if (tiket[type] > 0) {
        tiket[type]--;
        updateTiket();
    }

};


function updateTiket() {

    document.getElementById("vvip-count").innerHTML = tiket.vvip;
    document.getElementById("vip-count").innerHTML = tiket.vip;
    document.getElementById("regular-count").innerHTML = tiket.regular;


    document.getElementById("side-vvip").innerHTML = tiket.vvip;
    document.getElementById("side-vip").innerHTML = tiket.vip;
    document.getElementById("side-regular").innerHTML = tiket.regular;


    document.getElementById("price-vvip").innerHTML =
        formatRupiah(tiket.vvip * harga.vvip);

    document.getElementById("price-vip").innerHTML =
        formatRupiah(tiket.vip * harga.vip);

    document.getElementById("price-regular").innerHTML =
        formatRupiah(tiket.regular * harga.regular);


    let total =
        (tiket.vvip * harga.vvip) +
        (tiket.vip * harga.vip) +
        (tiket.regular * harga.regular) +
        5000;


    document.getElementById("total-price").innerHTML =
        formatRupiah(total);

}



function formatRupiah(number) {

    return "Rp " + number.toLocaleString("id-ID");

}