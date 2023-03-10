{{-- menampilkan tampilan template.blade.php  pada folder layout --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@extends('layout.template')
      
{{-- menentukan area yang akan diisi dan di simpan pada file layout/template dengan penggunaan 
    direktif @yield dalam konten file template  --}}
@section('konten')

<!-- START FROM -->

  <form action="{{url('siswa/'.$data->nis)}}" method='post' enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <div class="my-3 p-3 bg-body rounded shodow-sm">
              <a href="{{url('siswa')}}" class="btn btn-secondary"><< Kembali</a>
                <div class="mb-3 row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                       {{$data->nis}}
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="nama" class="col -sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama">
                    </div>
              </div>
              <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='jurusan' value="{{$data->jurusan}}" id="jurusan">
                    </div>
                  
                  </div>
              <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='kelas' value="{{$data->kelas}}" id="kelas">
                    </div>
                  
                  </div>
              <div class="mb-3 row">
                <label for="TTL" class="col-sm-2 col-form-label">TTL</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name='TTL' value="{{$data->TTL}}" id="TTL">
                    </div>
                  
                  </div>
               
                  <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        @if ($data->image)
                            <img src="{{ asset('storage/' .$data->image)}}" class="" style="width: 50px;height:50px">
                        @else
                            <img class="img_preview img-fluid mb-3 col-sm-5">
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                
                    <div class="col-sm-10">
              
                            <input  type="file" class="form-control" name="image" id="image"  >
                     
                    </div>
                </div>
                <label for="jurusan" class="col-sm-2 col-form-label"></label>
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
              </div>
            </form>
          </div>
<!-- AKHIR FORM -->




{{-- 
<script>
  
  function previewImage(){

    const image = document.querySelector('#image');
const img_preview = document.querySelector('.img_preview');

img_preview.style.display = 'block';

const ofReader = new FileReader();
ofReader.readAsDataURL(image.files[0]);
ofReader.onload = function(oFREvent){
img_preview.src = oFREvent.target.result;
}
}

</script> --}}
@endsection