{{-- menampilkan tampilan template app.blade.php  pada folder layouts --}}
{{-- navbar --}}
@extends('layouts.app')
      
{{-- menentukan area yang akan diisi dan di simpan pada file layouts/app dengan penggunaan 
    direktif @yield dalam konten file app  --}}
@section('konten')

<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shodow-sm" >
    @include('komponen.pesan')
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('siswa')}}" method="get">
            <input class="form-control me-1" type="search" name="katakunci"
            value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Sreach">
            <button class="btn btn-secondary" type="submit">Cari</button>
</form>
</div>
<!-- TOMBOL TAMBAH DATA -->
{{-- mengarah ke halaman tambah data pada function create controller --}}
<div class="pb-3">
    <a href="{{url('siswa/create')}}" class="btn btn-primary">+ Tambah Data</a>
</div>

{{-- membuat tabel --}}
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-md-1">NO</th>
            <th class="col-md-2">NIS</th>
            <th class="col-md-2">Nama</th>
            <th class="col-md-2">Jurusan</th>
            <th class="col-md-2">Kelas</th>
            <th class="col-md-1">TTL</th>
            <th class="col-md-2">image</th>
            <th class="col-md-2">Aksi</th>
         </tr>
       </thead>
</tbody>


<?php $i =$data->firstItem()?>

{{-- menampilkan isi dari variabel $data --}}
{{-- isi tersebut di ambil dari seluruh data pada tabel siswa yang sudah di konfigurasi pada controller index --}}
@foreach ( $data as $item )
<tr>
    {{-- $i digunakan untuk menampilkan nomor urut pada setiap baris data. --}}
    <td>{{$i}}</td>
    <td>{{$item->nis}}</td>
    <td>{{$item->nama}}</td>
    <td>{{$item->jurusan}}</td>
    <td>{{$item->kelas}}</td>
    <td>{{$item->TTL}}</td>
   
    <td>
         <img src="{{ asset('storage/'. $item->image)}}" style="widht:50px;height:50px" alt="">
    </td>
    <td>

      
        <a href="{{url('siswa/'.$item->nis.'/edit')}}"
         class="btn btn-warning btn-sm">Edit</a>

       
        <form onsubmit ="return confirm ('Yakin akan menghapus data?')"
        class='d-inline' action="{{'siswa/'.$item->nis}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" name="submit" class="btn btn-danger btn-sm mt-1">Hapus</button>
</form>
</td>
</tr>
{{-- menambah 1 data setiap datanya terulang --}}
<?php $i++?>
@endforeach
<tbody>
    <table>

{{--  menampilkan tautan navigasi halaman dalam bentuk laravel pagination. --}}
{{$data->withQueryString()->links()}}
    <div>
        <!-- AKHIR DATA -->
@endsection