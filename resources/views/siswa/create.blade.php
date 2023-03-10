{{-- menampilkan tampilan template.blade.php  pada folder layout --}}

@extends('layout.template')
      
{{-- menentukan area yang akan diisi dan di simpan pada file layout/template dengan penggunaan 
    direktif @yield dalam konten file template  --}}
@section('konten')
<!-- START FROM -->

  <form action="{{url('siswa')}}" method='post' enctype="multipart/form-data">
    @csrf
            <div class="my-3 p-3 bg-body rounded shodow-sm">
                <div class="mb-3 row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name='nis' value="{{Session::get('nis')}}" id="nis">
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="nama" class="col -sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' value="{{Session::get('nama')}}" id="nama">
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='jurusan' value="{{Session::get('jurusan')}}" id="jurusan">
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='kelas' value="{{Session::get('kelas')}}" id="kelas">
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="TTL" class="col-sm-2 col-form-label">TTL</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name='TTL' value="{{Session::get('TTL')}}" id="TTL">
                    </div>
              </div>
              <div class="mb-3 row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name='image' value="{{Session::get('image')}}" id="image">
                   </div>
               </div>
                <label for="jurusan" class="col-sm-2 col-form-label"></label>
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
              </div>
            </form>
          </div>
<!-- AKHIR FORM -->
@endsection