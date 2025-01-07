<!-- Footer -->
<footer class="bg-[color:var(--main-color)] text-white text-sm py-6 mt-9" id="contact">
  <p class="text-center text-white font-bold text-sm">&nbsp; Done 2024. All Rights Reserved.</p>
</footer>

<!-- Skrip JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#Table1, #Table1').DataTable({
      language: {
        search: "Cari Data:",
      },

    });

    // Tambahkan placeholder ke input search
    $('.dataTables_filter input').attr('placeholder', 'Ketik untuk mencari...');
  });
</script>
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
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "Your transaction is safe :)",
          icon: "error"
        });
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
    w
    // Hapus parameter "success" dari URL
    const url = new URL(window.location.href);
    url.searchParams.delete('success');
    window.history.replaceState({}, document.title, url.toString());
  }
</script>
<script>
  // Apply saved colors on page load
  document.addEventListener('DOMContentLoaded', function() {
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
  document.getElementById('save-color').addEventListener('click', function() {
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
<script>
    // Get the PHP-generated data
    const labels = <?= $labels_json ?>;
    const data = <?= $data_json ?>;

    // Create the line chart
    const lineChart = new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Activity',
          data: data,
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          tension: 0.4, // Smooth curve
        }],
      },
      options: {
        plugins: {
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleFont: {
              size: 14,
            },
            bodyFont: {
              size: 12,
            },
          },
        },
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });


    const pieChart = new Chart(document.getElementById('pieChart'), {
      type: 'pie',
      data: {
        labels: ['Selesai', 'Sedang Dikerjakan', 'Terlambat'],
        datasets: [{
          label: 'Status Tugas',
          data: [<?= $status_counts['Selesai'] ?>, <?= $status_counts['Sedang Dikerjakan'] ?>, <?= $status_counts['Terlambat'] ?>], // Update with actual data
          backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
        }],
      },
      options: {
        plugins: {
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleFont: {
              size: 15
            },
            bodyFont: {
              size: 12
            }
          }
        }
      }
    });

    function toggleTask(checkbox) {
      if (checkbox.checked) {
        checkbox.parentElement.classList.add('line-through', 'opacity-50');
      } else {
        checkbox.parentElement.classList.remove('line-through', 'opacity-50');
      }
    }

    function toggleTask(checkbox) {
      const idTugas = checkbox.getAttribute('data-tugas-id');
      const status = checkbox.checked ? 'Selesai' : 'Sedang Dikerjakan';

      // Kirim permintaan AJAX untuk memperbarui status
      fetch('', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id_tugas=${idTugas}&status=${status}`,
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            checkbox.nextElementSibling.classList.toggle('line-through', checkbox.checked);
            checkbox.nextElementSibling.classList.toggle('text-gray-400', checkbox.checked);
            // Auto-refresh halaman setelah sukses
            location.reload();
          } else {
            alert('Gagal mengubah status tugas: ' + data.error);
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
