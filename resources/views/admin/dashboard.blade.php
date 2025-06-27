@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="p-2">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, Admin!</h1>
        <ul class="list-disc ml-6">
            <li>Manajemen Proyek (CRUD Project)</li>
            <li>Manajemen Anggota Proyek</li>
            <li>Penugasan & Penjadwalan Tugas</li>
            <li>Pengingat Otomatis (Reminder)</li>
            <li>Manajemen User (CRUD User)</li>
        </ul>
    </div>
@endsection
