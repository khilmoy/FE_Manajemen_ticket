document.addEventListener('DOMContentLoaded', () => {

    const paymentForm = document.getElementById('paymentForm');
    if (!paymentForm) return;

    const API_URL = window.API_URL;
    const token = localStorage.getItem('token');

    // ==========================
    // AMBIL DATA ORDER
    // ==========================
    // Struktur yang dibutuhkan:
    // {
    //   tickets: [ { id: 3, name: 'VVIP', price: 750000, qty: 2 }, ... ],
    //   total: 1505000
    // }
    // PENTING: field "id" di setiap tiket harus berisi ticket_id ASLI dari
    // database (tabel tickets), bukan label kategori. Ini wajib disiapkan
    // dari halaman detail konser saat menyimpan ke localStorage.
    let order = null;

    try {
        order = JSON.parse(localStorage.getItem('orderData'));
    } catch (e) {
        order = null;
    }

    if (!order || !Array.isArray(order.tickets) || order.tickets.length === 0) {
        localStorage.removeItem('orderData');
        alert("Data pesanan tidak ditemukan. Silakan pilih tiket terlebih dahulu.");
        window.location.href = "/";
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

        try {

            const createdOrderIds = [];

            // 1 order = 1 ticket_id, jadi kirim satu-satu per jenis tiket
            for (const ticket of order.tickets) {

                if (!ticket.id) {
                    throw new Error(`ticket_id untuk "${ticket.name}" tidak ditemukan. Cek data dari halaman detail.`);
                }

                const formData = new FormData();
                formData.append('ticket_id', ticket.id);
                formData.append('quantity', ticket.qty);
                formData.append('image', fileInput.files[0]);

                const response = await fetch(`${API_URL}/orders`, {
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
                    button.disabled = false;
                    button.textContent = "Kirim Pembayaran";
                    return;
                }

                createdOrderIds.push(data.id);
            }

            localStorage.removeItem('orderData');

            // Redirect ke halaman status order
            window.location.href = "/order/" + createdOrderIds[0];

        } catch (error) {
            alertBox.textContent = error.message || "Tidak dapat terhubung ke server.";
            alertBox.classList.remove('hidden');
        } finally {
            button.disabled = false;
            button.textContent = "Kirim Pembayaran";
        }

    });

});