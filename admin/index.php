<?php
include 'user_management.php';

$users = getAllUsers($conn);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">
    <?php include('../utils/navbar.php'); ?>

    <div class="container mx-auto p-6">

        <!-- Daftar User -->
        <div>
            <h2 class="text-2xl font-bold">Daftar User</h2>
            <table class="min-w-full table-auto mt-4">
                <thead>
                    <tr>
                        <th class="border-b px-4 py-2">ID</th>
                        <th class="border-b px-4 py-2">Nama</th>
                        <th class="border-b px-4 py-2">Email</th>
                        <th class="border-b px-4 py-2">Username</th>
                        <th class="border-b px-4 py-2">Role</th>
                        <th class="border-b px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td class="border-b px-4 py-2"><?= $user['id'] ?></td>
                            <td class="border-b px-4 py-2"><?= $user['name'] ?></td>
                            <td class="border-b px-4 py-2"><?= $user['email'] ?></td>
                            <td class="border-b px-4 py-2"><?= $user['username'] ?></td>
                            <td class="border-b px-4 py-2">
                                <?php
                                $role = getRoleById($conn, $user['role_id']);
                                echo $role['name'];
                                ?>
                            </td>
                            <td class="border-b px-4 py-2">
                                <a href="edit_user.php?edit=<?= $user['id'] ?>" class="text-blue-500 hover:text-blue-600">Edit</a>
                                <a href="delete_user.php?delete=<?= $user['id'] ?>" class="text-red-500 hover:text-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script>
    // Toggle dropdown menu
    document.getElementById('profileMenu').addEventListener('click', () => {
      const menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    });
  </script>

</body>

</html>