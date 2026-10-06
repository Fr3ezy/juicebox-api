<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Selamat Datang!</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Halo, {{ $user->name }}! 👋</h2>
    <p>Selamat bergabung di platform kami. Akun kamu dengan email <strong>{{ $user->email }}</strong> telah berhasil terdaftar.</p>
    <p>Terima kasih telah mendaftar!</p>
</body>
</html>