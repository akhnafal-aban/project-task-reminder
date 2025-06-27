@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="bg-dark p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, Admin!</h1>
        <p class="mb-4 text-[#b3b3b3]">Gunakan <span class="font-semibold text-[#38d4ae]">navbar di sebelah kiri</span> untuk mengakses dan menguji seluruh fitur admin. Setiap menu di sidebar akan membawa Anda ke halaman utama fitur terkait.</p>
        <ul class="list-disc ml-6 mb-6">
            <li>Manajemen Proyek (CRUD Project)</li>
            <li>Manajemen Anggota Proyek</li>
            <li>Penugasan & Penjadwalan Tugas</li>
            <li>Pengingat Otomatis (Reminder)</li>
            <li>Manajemen User (CRUD User)</li>
        </ul>
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-[#38d4ae] mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                Dokumentasi Fitur Admin
            </h2>
            <ul class="list-disc ml-6 text-[#b3b3b3] text-sm space-y-2">
                <li><span class="font-semibold text-[#38d4ae]">Manajemen Proyek:</span> Membuat, mengedit, menghapus, dan melihat detail proyek beserta anggota dan tugasnya.</li>
                <li><span class="font-semibold text-[#38d4ae]">Manajemen Anggota:</span> Menambah atau menghapus anggota pada proyek tertentu.</li>
                <li><span class="font-semibold text-[#38d4ae]">Penugasan & Penjadwalan Tugas:</span> Membuat dan mengatur tugas, menentukan prioritas, deadline, dan penanggung jawab.</li>
                <li><span class="font-semibold text-[#38d4ae]">Pengingat Otomatis:</span> Mengatur dan mengirim pengingat otomatis untuk tugas yang mendekati deadline.</li>
                <li><span class="font-semibold text-[#38d4ae]">Manajemen User:</span> Membuat, mengedit, menghapus, dan melihat detail user dalam sistem.</li>
            </ul>
            <div class="mt-8 p-4 bg-[#18181b] rounded border border-[#38383f]">
                <h3 class="font-semibold text-[#38d4ae] mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg>
                    Panduan Test Fitur Reminder (Email)
                </h3>
                <p class="text-[#b3b3b3] text-sm mb-2">Untuk melakukan testing pengiriman email reminder secara manual, gunakan perintah berikut di terminal:</p>
                <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#38d4ae] mb-2">php artisan tinker</div>
                <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#b3b3b3]">&gt;&gt;&gt; Mail::raw('Test email', function($m){ $m->to('akhnafal03@gmail.com')->subject('Test'); });</div>
                <p class="text-[#b3b3b3] text-xs mt-2">Ganti alamat email sesuai kebutuhan. Jika berhasil, email akan terkirim ke alamat yang dituju.</p>
                <div class="mt-4">
                    <p class="text-[#b3b3b3] text-sm mb-2">Atau jalankan command berikut untuk langsung menguji fitur reminder otomatis sesuai logic aplikasi:</p>
                    <div class="bg-[#232329] text-xs rounded p-3 font-mono text-[#38d4ae]">php artisan tasks:send-reminders</div>
                    <p class="text-[#b3b3b3] text-xs mt-2">Command ini akan menjalankan logic pengiriman email reminder ke user yang memiliki tugas mendekati deadline.</p>
                    <p class="text-[#b3b3b3] text-xs mt-2">Mohon Ganti email "akhnafal03@gmail.com" dengan email anda untuk mengetahui apakah benar benar terkirim</p>

                </div>
            </div>
        </div>
    </div>
@endsection
