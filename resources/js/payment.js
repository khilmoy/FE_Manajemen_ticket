document.addEventListener('DOMContentLoaded', () => {

    const paymentForm = document.getElementById('paymentForm');
    if (!paymentForm) return;

    const API_URL = window.API_URL;
    const token = localStorage.getItem('token');

    // ==========================
    // AMBIL DATA ORDER
    // ==========================
    let order = null;

    try {
        order = JSON.parse(localStorage.getItem('orderData'));
    } catch (e) {
        order = null;
    }

    // Validasi struktur data
    if (!order || !Array.isArray(order.tickets) || order.tickets.length === 0) {

        localStorage.removeItem('orderData'); // bersihkan data basi
        alert("Data pesanan tidak ditemukan. Silakan pilih tiket terlebih dahulu.");
        window.location.href = "/"; // atau ke halaman daftar konser
        return;

    }

    let html = "";

    order.tickets.forEach(ticket => {
        html += `
            <div class="flex justify-between mb-2">
                <span>${ticket.name} x${ticket.qty}</span>
                <span>Rp ${(ticket.qty * ticket.price).toLocaleString('id-ID')}</span>
            </div>
        `;
    });

    html += `
        <div class="flex justify-between mt-3">
            <span>Biaya Admin</span>
            <span>Rp 5.000</span>
        </div>
    `;

    document.getElementById('ticketDetail').innerHTML = html;

    document.getElementById('ticketTotal').textContent =
        "Rp " + Number(order.total || 0).toLocaleString('id-ID');

    // ==========================
    // SUBMIT PAYMENT
    // ==========================
    paymentForm.addEventListener('submit', async function (e) {

        e.preventDefault();

        const button = document.getElementById('submitBtn');
        const alertBox = document.getElementById('alertError');
        const fileInput = document.getElementById('paymentProof');

        alertBox.classList.add('hidden');
        alertBox.textContent = "";

        if (!fileInput.files[0]) {
            alertBox.textContent = "Silakan pilih bukti pembayaran.";
            alertBox.classList.remove('hidden');
            return;
        }

        button.disabled = true;
        button.textContent = "Mengirim...";

        const formData = new FormData();
        formData.append('payment_proof', fileInput.files[0]);
        formData.append('tickets', JSON.stringify(order.tickets));
        formData.append('total_price', order.total);

        try {

            const response = await fetch(`${API_URL}/order/payment-proof`, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${token}`
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                const message = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : (data.message || "Gagal mengirim pembayaran.");
                alertBox.textContent = message;
                alertBox.classList.remove('hidden');
                return;
            }

            localStorage.removeItem('orderData');
            window.location.href = "/invoice";

        } catch (error) {
            alertBox.textContent = "Tidak dapat terhubung ke server.";
            alertBox.classList.remove('hidden');
        } finally {
            button.disabled = false;
            button.textContent = "Kirim Pembayaran";
        }

    });

});