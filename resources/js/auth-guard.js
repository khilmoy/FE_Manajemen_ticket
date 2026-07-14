/**
 * auth-guard.js
 * Helper global untuk cek login sebelum mengakses halaman/aksi
 * yang butuh token (misal: beli tiket, lihat status order).
 *
 * Cara pakai di script lain:
 *   const token = requireAuth('/beli-ticket');
 *   if (!token) return; // otomatis sudah redirect ke /login
 */
window.requireAuth = function (redirectPath) {
    const token = localStorage.getItem('token');

    if (!token) {
        const target = redirectPath || window.location.pathname;
        window.location.href = '/login?redirect=' + encodeURIComponent(target);
        return null;
    }

    return token;
};

window.getAuthUser = function () {
    try {
        return JSON.parse(localStorage.getItem('user'));
    } catch (e) {
        return null;
    }
};

window.logout = function () {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('orderData');
    window.location.href = '/';
};