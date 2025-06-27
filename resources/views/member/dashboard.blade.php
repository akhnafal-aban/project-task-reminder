@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, Member!</h1>
        <ul class="list-disc ml-6">
            <li>Melihat Daftar Proyek yang Diikuti</li>
            <li>Melihat Daftar Anggota Proyek</li>
            <li>Melihat & Mengakses Tugas</li>
            <li>Update Status Tugas</li>
            <li>Menambahkan Keterangan/Komentar</li>
            <li>Menerima Reminder Otomatis</li>
        </ul>
        <p class="mt-4 text-gray-600">Gunakan menu di atas untuk mengelola tugas Anda.</p>
    </div>
@endsection 