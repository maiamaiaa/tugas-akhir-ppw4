<?php
session_start();

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

$message = '';
$messageType = '';

$editMode = false;
$editId = null;
$editData = ['name' => '', 'phone' => '', 'email' => '', 'address' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Nama harus diisi";
    }
    
    if (empty($phone)) {
        $errors[] = "Nomor telepon harus diisi";
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $phone)) {
        $errors[] = "Nomor telepon tidak valid";
    }
    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($errors)) {
        if ($_POST['action'] === 'add') {
            $id = uniqid();
            $_SESSION['contacts'][$id] = [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address
            ];
            $message = "Kontak berhasil ditambahkan!";
            $messageType = "success";
        } elseif ($_POST['action'] === 'update') {

            $id = $_POST['id'];
            if (isset($_SESSION['contacts'][$id])) {
                $_SESSION['contacts'][$id] = [
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address
                ];
                $message = "Kontak berhasil diupdate!";
                $messageType = "success";
            }
        }
    } else {
        $message = implode("<br>", $errors);
        $messageType = "error";
        
        $editData = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ];
        
        if ($_POST['action'] === 'update') {
            $editMode = true;
            $editId = $_POST['id'];
        }
    }
}

if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    if (isset($_SESSION['contacts'][$editId])) {
        $editMode = true;
        $editData = $_SESSION['contacts'][$editId];
    }
}

if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    if (isset($_SESSION['contacts'][$deleteId])) {
        unset($_SESSION['contacts'][$deleteId]);
        $message = "Kontak berhasil dihapus!";
        $messageType = "success";
    }
}

if (isset($_GET['clear'])) {
    $_SESSION['contacts'] = [];
    $message = "Semua kontak berhasil dihapus!";
    $messageType = "success";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kontak</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sistem Manajemen Kontak</h1>
            <p>Kelola kontak Anda dengan mudah</p>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <h2><?php echo $editMode ? 'Edit Kontak' : 'Tambah Kontak Baru'; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="<?php echo $editMode ? 'update' : 'add'; ?>">
                <?php if ($editMode): ?>
                    <input type="hidden" name="id" value="<?php echo $editId; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($editData['name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Nomor Telepon *</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($editData['phone']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($editData['email']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address"><?php echo htmlspecialchars($editData['address']); ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <?php echo $editMode ? 'Update Kontak' : 'Tambah Kontak'; ?>
                </button>
                
                <?php if ($editMode): ?>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="card">
            <h2>Daftar Kontak</h2>
            
            <?php if (!empty($_SESSION['contacts'])): ?>
                <div class="stats">
                    <h3><?php echo count($_SESSION['contacts']); ?></h3>
                    <p>Total Kontak Tersimpan</p>
                </div>
                
                <div class="contact-list">
                    <?php foreach ($_SESSION['contacts'] as $id => $contact): ?>
                        <div class="contact-item">
                            <div class="contact-header">
                                <div class="contact-name"><?php echo htmlspecialchars($contact['name']); ?></div>
                                <div>
                                    <a href="?edit=<?php echo $id; ?>" class="btn btn-edit">Edit</a>
                                    <a href="?delete=<?php echo $id; ?>" 
                                       class="btn btn-danger" 
                                       onclick="return confirm('Yakin ingin menghapus kontak ini?')">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                            <div class="contact-info">
                                <strong>Telepon:</strong> <?php echo htmlspecialchars($contact['phone']); ?>
                            </div>
                            <?php if (!empty($contact['email'])): ?>
                                <div class="contact-info">
                                    <strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($contact['address'])): ?>
                                <div class="contact-info">
                                    <strong>Alamat:</strong> <?php echo htmlspecialchars($contact['address']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="clear-all">
                    <a href="?clear=1" 
                       class="btn btn-danger" 
                       onclick="return confirm('Yakin ingin menghapus SEMUA kontak?')">
                        Hapus Semua Kontak
                    </a>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>Belum Ada Kontak</h3>
                    <p>Silakan tambahkan kontak baru menggunakan form di atas</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
