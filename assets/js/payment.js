
    // Ambil elemen modal dan elemen lain
    const modal = document.getElementById("paymentModal");
    const openModal = document.getElementById("openModal");
    const closeModal = document.getElementById("closeModal");
    const paymentOptions = document.querySelectorAll(".payment-option");
    const selectedMethodText = document.getElementById("selectedMethod");

    // Buka modal
    openModal.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // Tutup modal
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Pilih metode pembayaran
    paymentOptions.forEach(option => {
        option.addEventListener("click", () => {
            const selectedMethod = option.getAttribute("data-method"); // Ambil data-method
            selectedMethodText.innerHTML = `<strong>Metode Terpilih: ${selectedMethod}</strong>`; // Tampilkan pilihan
            modal.style.display = "none"; // Tutup modal
        });
    });

    // Tutup modal jika klik di luar modal-content
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

