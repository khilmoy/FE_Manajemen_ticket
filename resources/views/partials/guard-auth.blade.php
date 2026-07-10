<script>
    (function () {
        const token = localStorage.getItem('token');

        if (!token) {
            window.location.href = `/login?redirect=${encodeURIComponent(window.location.pathname + window.location.search)}`;
        }
    })();
</script>