function downloadPDF() {
  const element = document.querySelector("main");

  html2pdf().from(element).set({
    margin: 0.5,
    filename: 'Kebijakan-Privasi-AksaraLoka.pdf',
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
  }).save();
}