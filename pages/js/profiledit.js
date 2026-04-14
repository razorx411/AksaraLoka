// ambil data user saat halaman dibuka
window.addEventListener("DOMContentLoaded", async () => {
  const res = await fetch("../api/get_profile.php");
  const data = await res.json();

  if (data.success) {
    document.querySelector('[name="nama"]').value = data.user.nama;
    document.querySelector('[name="email"]').value = data.user.email;
  } else {
    alert("Gagal ambil data user");
  }
});