@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
    <div class="bg-dark p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, Member!</h1>
        <p class="mb-4 text-[#b3b3b3]">Silakan gunakan <span class="font-semibold text-[#38d4ae]">navbar di sebelah
                kiri</span> untuk mengakses dan menguji seluruh fitur yang tersedia untuk member. Setiap menu di sidebar
            akan membawa Anda ke halaman utama fitur terkait.</p>
        <ul class="list-disc ml-6 mb-6">
            <li>Melihat Daftar Proyek yang Diikuti</li>
            <li>Melihat Daftar Anggota Proyek</li>
            <li>Melihat & Mengakses Tugas</li>
            <li>Update Status Tugas</li>
            <li>Menambahkan Keterangan/Komentar</li>
            <li>Menerima Reminder Otomatis</li>
        </ul>
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-[#38d4ae] mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                Dokumentasi Fitur Member
            </h2>
            <ul class="list-disc ml-6 text-[#b3b3b3] text-sm space-y-2">
                <li><span class="font-semibold text-[#38d4ae]">Proyek Saya:</span> Melihat daftar proyek yang Anda ikuti
                    beserta detail dan anggota proyek.</li>
                <li><span class="font-semibold text-[#38d4ae]">Tugas:</span> Melihat, mengakses, dan memperbarui status
                    tugas yang diberikan kepada Anda.</li>
                <li><span class="font-semibold text-[#38d4ae]">Komentar Tugas:</span> Menambahkan komentar atau keterangan
                    pada tugas untuk kolaborasi tim.</li>
                <li><span class="font-semibold text-[#38d4ae]">Reminder Otomatis:</span> Mendapatkan pengingat otomatis
                    untuk tugas yang mendekati deadline melalui email.</li>
                <li><span class="font-semibold text-[#38d4ae]">Profil:</span> Melihat dan memperbarui informasi profil Anda.
                </li>
            </ul>
        </div>
        <div class="mt-8 p-4 bg-[#18181b] rounded border border-[#38383f]">
            <h3 class="font-semibold text-[#38d4ae] mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                </svg>
                Panduan Test Fitur Reminder (Email)
            </h3>
            <p class="text-[#b3b3b3] text-sm mb-2">Untuk melakukan testing pengiriman email reminder secara manual, gunakan
                perintah berikut di terminal:</p>
            <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#38d4ae] mb-2">php artisan tinker</div>
            <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#b3b3b3]">&gt;&gt;&gt; Mail::raw('Test email',
                function($m){ $m->to('akhnafal03@gmail.com')->subject('Test'); });</div>
            <p class="text-[#b3b3b3] text-xs mt-2">Ganti alamat email sesuai kebutuhan. Jika berhasil, email akan terkirim
                ke alamat yang dituju.</p>
            <div class="mt-4">
                <p class="text-[#b3b3b3] text-sm mb-2">Atau jalankan command berikut untuk langsung menguji fitur reminder
                    otomatis sesuai logic aplikasi:</p>
                <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#38d4ae]">php artisan tasks:send-reminders
                </div>
                <p class="text-[#b3b3b3] text-xs mt-2">Command ini akan menjalankan logic pengiriman email reminder ke user
                    yang memiliki tugas mendekati deadline.</p>
                <p class="text-[#b3b3b3] text-xs mt-2">Mohon Ganti email "akhnafal03@gmail.com" dengan email anda untuk
                    mengetahui apakah benar benar terkirim</p>

            </div>
        </div>
    </div>
@endsection
