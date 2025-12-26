# 🔧 LARAVEL TINKER COMMANDS UNTUK ADMIN

## 📋 CARA MENGGUNAKAN

1. Buka terminal di root project
2. Jalankan: `php artisan tinker`
3. Copy-paste command di bawah ini

---

## ✅ MEMBUAT ADMIN USER BARU

### **Command 1: Buat Admin dengan Password Hash**

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

Admin::create([
    'name' => 'Admin Neovala',
    'email' => 'Admin@neovalaofficial.com',
    'password' => Hash::make('Papaya333neovala.')
]);
```

**Output**: Admin baru akan dibuat dengan:
- Name: Admin Neovala
- Email: admin@neovala.com
- Password: password123

---

### **Command 2: Buat Admin dengan Password Kustom**

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

$admin = new Admin();
$admin->name = 'Super Admin';
$admin->email = 'superadmin@neovala.com';
$admin->password = Hash::make('admin123456');
$admin->save();
```

---

### **Command 3: Buat Multiple Admin (Batch)**

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

$admins = [
    [
        'name' => 'Admin 1',
        'email' => 'admin1@neovala.com',
        'password' => Hash::make('password123')
    ],
    [
        'name' => 'Admin 2',
        'email' => 'admin2@neovala.com',
        'password' => Hash::make('password123')
    ]
];

foreach ($admins as $adminData) {
    Admin::create($adminData);
}
```

---

## 🔍 MELIHAT DATA ADMIN

### **Command 4: Lihat Semua Admin**

```php
use App\Models\Admin;

Admin::all();
```

### **Command 5: Lihat Admin Berdasarkan Email**

```php
use App\Models\Admin;

Admin::where('email', 'admin@neovala.com')->first();
```

### **Command 6: Lihat Admin dengan Format yang Lebih Readable**

```php
use App\Models\Admin;

Admin::all()->map(function($admin) {
    return [
        'id' => $admin->id,
        'name' => $admin->name,
        'email' => $admin->email,
        'created_at' => $admin->created_at
    ];
});
```

---

## 🔄 UPDATE ADMIN

### **Command 7: Update Password Admin**

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

$admin = Admin::where('email', 'admin@neovala.com')->first();
$admin->password = Hash::make('newpassword123');
$admin->save();
```

### **Command 8: Update Name Admin**

```php
use App\Models\Admin;

$admin = Admin::where('email', 'admin@neovala.com')->first();
$admin->name = 'Admin Updated';
$admin->save();
```

---

## 🗑️ HAPUS ADMIN

### **Command 9: Hapus Admin Berdasarkan Email**

```php
use App\Models\Admin;

Admin::where('email', 'admin@neovala.com')->delete();
```

### **Command 10: Hapus Admin Berdasarkan ID**

```php
use App\Models\Admin;

Admin::find(1)->delete();
```

---

## 🧪 TEST LOGIN ADMIN

### **Command 11: Test Login dengan Tinker**

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Cek apakah email dan password cocok
$admin = Admin::where('email', 'admin@neovala.com')->first();

if ($admin && Hash::check('password123', $admin->password)) {
    echo "Password cocok! Admin bisa login.";
} else {
    echo "Password tidak cocok!";
}
```

---

## 📝 CONTOH LENGKAP: BUAT ADMIN & TEST

```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// 1. Buat admin baru
$admin = Admin::create([
    'name' => 'Admin Neovala',
    'email' => 'admin@neovala.com',
    'password' => Hash::make('admin123')
]);

// 2. Cek admin yang baru dibuat
echo "Admin created: " . $admin->name . " (" . $admin->email . ")\n";

// 3. Test password
if (Hash::check('admin123', $admin->password)) {
    echo "Password verified successfully!\n";
}

// 4. Lihat semua admin
echo "Total admins: " . Admin::count() . "\n";
```

---

## 🚨 PENTING: SECURITY

**JANGAN** hardcode password di production!

**Gunakan**:
- Password yang kuat (minimal 8 karakter, kombinasi huruf, angka, simbol)
- Ganti password default setelah pertama kali login
- Jangan commit password ke Git

---

## 📋 QUICK REFERENCE

| Action | Command |
|--------|---------|
| **Buat Admin** | `Admin::create(['name' => '...', 'email' => '...', 'password' => Hash::make('...')])` |
| **Lihat Semua** | `Admin::all()` |
| **Cari by Email** | `Admin::where('email', '...')->first()` |
| **Update Password** | `$admin->password = Hash::make('...'); $admin->save();` |
| **Hapus Admin** | `Admin::where('email', '...')->delete()` |
| **Count Admin** | `Admin::count()` |

---

**Status**: Ready to Use  
**Created**: 2025-01-XX  
**Version**: 1.0

