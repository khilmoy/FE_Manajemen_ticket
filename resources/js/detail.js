document.addEventListener('DOMContentLoaded', () => {

    const beliTiketBtn = document.getElementById('beliTiketBtn');

    if (!beliTiketBtn) return;

    beliTiketBtn.addEventListener('click', () => {

        let total = 5000;
        let jumlah = 0;

        const orderData = {
            tickets: []
        };

        for (const id in window.tiket) {

            const qty = window.tiket[id];

            if (qty > 0) {

                jumlah += qty;
                total += qty * window.harga[id];

                orderData.tickets.push({
                    id: Number(id),
                    name: window.nama[id],
                    qty: qty,
                    price: window.harga[id]
                });

            }
        }

        if (jumlah === 0) {
            alert("Silakan pilih minimal 1 tiket.");
            return;
        }

        orderData.total = total;

        localStorage.setItem("orderData", JSON.stringify(orderData));

        // Cek login dulu. Kalau belum login, requireAuth() otomatis
        // redirect ke /login?redirect=/beli-ticket dan return null.
        const token = window.requireAuth('/beli-ticket');
        if (!token) return;

        window.location.href = "/beli-ticket";

    });

});