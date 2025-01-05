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
       <script>
        function confirmDelete(taskId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tugas ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form jika dikonfirmasi
                    document.getElementById(`deleteForm-${taskId}`).submit();
                }
            });
        }
    </script>
    <script>
        // Cek apakah URL memiliki parameter "success"
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            // Tampilkan pesan pop-up menggunakan SweetAlert
            Swal.fire({
                title: 'Berhasil!',
                text: 'Tugas berhasil diperbarui.',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            // Hapus parameter "success" dari URL
            const url = new URL(window.location.href);
            url.searchParams.delete('success');
            window.history.replaceState({}, document.title, url.toString());
        }
    </script>