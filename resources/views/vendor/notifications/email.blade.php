@component('mail::message')

<div style="text-align: center;">
    <img src="https://github.com/0xcu8e5p4c3/astacita/blob/main/public/images/astacitalogo.png?raw=true" alt="Logo" width="300" style="margin-bottom: 20px;">
</div>

{{-- Cek apakah email ini Reset Password atau Verifikasi --}}
@if ($actionText === 'Reset Password')
# 🔒 Reset Password

Halo **{{ $user->name ?? 'Pengguna' }}**,

Kami menerima permintaan untuk mereset password kamu.  
Klik tombol di bawah ini untuk mengatur ulang password akunmu:

@component('mail::button', ['url' => $actionUrl, 'color' => 'red'])
Reset Password
@endcomponent

Jika kamu tidak meminta reset password, abaikan email ini.

@else
# 🎉 Selamat Datang di Astacita.co

Halo **{{ $user->name ?? 'Pengguna' }}**,

Terima kasih telah mendaftar. Kami hanya butuh satu langkah lagi —  
silakan klik tombol di bawah ini untuk **memverifikasi email kamu** dan mulai menikmati layanan dari kami.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Verifikasi Sekarang
@endcomponent

Jika kamu tidak merasa membuat akun, kamu bisa mengabaikan email ini.

@endif

---

**Butuh bantuan atau ada pertanyaan?**  
Hubungi kami di:  
📧 [support@astacita.id](mailto:support@astacita.id)

Terima kasih,  
Tim {{ config('app.name') }}

<hr style="margin-top: 32px; border: none; border-top: 1px solid #e5e7eb;">

<p style="font-size: 12px; color: #9ca3af; text-align: center;">
Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.
</p>

@endcomponent
