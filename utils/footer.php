   <!-- Footer -->
   <footer class="bg-gray-900 text-white text-sm py-6 mt-9" id="contact">
     <div class="container mx-auto text-center">
       <p>&copy; 2024 My Landing Page. All rights reserved.</p>
     </div>
   </footer>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   <script>
     // Toggle dropdown menu
     document.getElementById('profileMenu').addEventListener('click', () => {
       const menu = document.getElementById('dropdownMenu');
       menu.classList.toggle('hidden');
     });
     document.getElementById("menu-toggle").addEventListener("click", function() {
       document.getElementById("menu").classList.toggle("hidden");
     });
   </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
   <script>
     $(document).ready(function() {
       $('#Table1, Table1').DataTable({
         language: {
           search: "Cari Data:",
         }
       });

       // Tambahkan placeholder ke input search
       $('.dataTables_filter input').attr('placeholder', 'Ketik untuk mencari...');
     });
   </script>