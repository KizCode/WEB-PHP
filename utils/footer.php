<!-- Footer -->
<footer class="bg-[color:var(--main-color)] text-white text-sm py-6 mt-9" id="contact">
  <p class="text-center text-white font-bold text-sm">&nbsp; Done 2024. All Rights Reserved.</p>
</footer>

<!-- Skrip JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  // Apply saved colors on page load
  document.addEventListener('DOMContentLoaded', function () {
    const savedNavbarColor = localStorage.getItem('navbarColor');
    const savedBodyColor = localStorage.getItem('bodyColor');
    const savedFooterColor = localStorage.getItem('footerColor');
    
    if (savedNavbarColor) {
      document.getElementById('navbar').style.backgroundColor = savedNavbarColor;
    }
    if (savedBodyColor) {
      document.body.style.backgroundColor = savedBodyColor;
    }
    if (savedFooterColor) { // Apply saved footer color
      // Set the --main-color CSS variable for footer background
      document.documentElement.style.setProperty('--main-color', savedFooterColor);
    }
  });

  // Save the selected color to localStorage
  document.getElementById('save-color').addEventListener('click', function () {
    const newColor = document.getElementById('color-input').value;
    
    // Apply the color to navbar, body, and footer
    document.getElementById('navbar').style.backgroundColor = newColor;
    document.body.style.backgroundColor = newColor;
    document.documentElement.style.setProperty('--main-color', newColor); // Update CSS variable for footer color

    // Save the selected color to localStorage
    localStorage.setItem('navbarColor', newColor);
    localStorage.setItem('bodyColor', newColor);
    localStorage.setItem('footerColor', newColor); // Save footer color
  });
</script>
