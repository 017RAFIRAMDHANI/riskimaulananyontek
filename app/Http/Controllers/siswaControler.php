<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;





class siswaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $katakunci untuk menampung nilai request pada request katakunci yang dikirim pada server 
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;

        if (!Auth::user()) {
            return redirect()->route('login');
        } else {

            // Jika ada pencarian kata jalankan fungsi if namun jika tidak ada jalankan fungsi else
            if (strlen($katakunci)) {
               
                $data = siswa::where('nis', 'like', "%$katakunci%")
                    ->orWhere('nama', 'like', "%$katakunci%")
                    ->orWhere('jurusan', 'like', "%$katakunci%")
                    ->orWhere('kelas', 'like', "%$katakunci%")
                    ->orWhere('TTL', 'like', "%$katakunci%")
                    ->paginate($jumlahbaris);
            } else {
                // maka tampilkan seluruh data pada tabel siswa berdasarkan nis dengan mengurutkan descennding 
                // dan batasi data yang akan di tampilkan per page nya sesuai nilai pada $jumlahbaris
                $data = siswa::orderBy('nis', 'desc')->paginate($jumlahbaris);
            }
         
            return view('siswa.index')->with('data', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  create menampilkan halaman form untuk menambah data siswa baru pada file create di dalam  folder view/siswa.
    public function create()
    {
        // jika user belum login akan di alihkan paksa ke halaman login 
        // namun jika user sudah login akan langsung di aliohkan ke halaman index siswa
        if (!Auth::user()) {
            return redirect()->route('login');
        } else {
            return view('siswa.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

  
    public function store(Request $request)
    {
      
        Session::flash('nis', $request->nis);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);
        Session::flash('kelas', $request->kelas);
        Session::flash('TTL', $request->TTL);


        $validatedData = $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'TTL' => 'required',
            'image' => 'required|image|file',
        ], [
            'nis.required' => 'NIS harus di isi',
            'nis.numeric' => 'NIS harus dalam angka',
            'nis.unique' => 'NIS sudah ada',
            'nama.required' => 'Nama harus di isi',
            'jurusan.required' => 'Jurusan harus di isi',
            'Kelas.required' => 'Kelas harus di isi',
            'TTL.required' => 'TTL harus di isi',
            'image.required' => 'Gambar harus jpg atau png',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
      
        siswa::create($validatedData);

        return redirect()->to('siswa')->with('success', 'Data Berhasil Disimpan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // edit = menampilkan halaman form edit data siswa dengan mengambil data siswa dari database 
    // berdasarkan ID atau NIS yang diberikan. 
    // data siswa yang dicari berdasarkan NIS yang diambil dari parameter $id,
    // kemudian hasil query pertama akan dikirimkan ke view siswa.edit sebagai variabel $data.
    public function edit(Request $request, $id)
    {
        // jika user belum login akan di alihkan paksa ke halaman login 
        // namun jika user sudah login akan langsung di aliohkan ke halaman index siswa
        if (!Auth::user()) {
            return redirect()->route('login');
        } else {
            $data = siswa::where('nis', $id)->first();

            return view('siswa.edit')->with('data', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // update() = mengupdate data siswa yang sudah ada
    public function update(Request $request, $id)
    {
        // input data akan divalidasi sesuai dengan kriteria yang sudah ditetapkan
        // yang diinginkan, seperti NIS harus diisi dan dalam bentuk angka, dan gambar yang diunggah 
        // harus berupa file dengan ekstensi .jpg atau .png. Jika validasi sukses, gambar akan disimpan 


        $validatedData = $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'TTL' => 'required',
            'image' => 'image|file',


        ], [

            'nama.required' => 'Nama harus diisi',
            'jurusan.required' => 'Jurusan harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'TTL.required' => 'TTL harus diisi',



        ]);

        // jika gambar yang diinputkan diubah, gambar tersebut akan disimpan. 
        // Kemudian, data siswa akan diperbaharui dengan data yang sudah divalidasi dan gambar baru yang disimpan.
        if ($request->file('image')) {

            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // jika validasi sukses maka data akan ter update pada tabel siswa bersadarkan nis yang sudah 
        // dikirimkan pada server
        siswa::where('nis', $id)->update($validatedData);

        // akan diarahkan kembali ke halaman index siswa dengan pesan sukses.
        return redirect()->to('siswa')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // menghapus data siswa dari database berdasarkan nis  yang diterima sebagai parameter. 
    // Pada fungsi ini, kita menggunakan method delete pada tabel siswa 
    // untuk menghapus data siswa berdasarkan nis. Setelah data berhasil dihapus, 
    //  akan di-redirect kembali ke halaman index dengan pesan sukses
    public function destroy($id)
    {
        // jika user belum login akan di alihkan paksa ke halaman login 
        // namun jika user sudah login akan langsung di aliohkan ke halaman index siswa
        if (!Auth::user()) {
            return redirect()->route('login');
        } else {
            siswa::where('nis', $id)->delete();
            return redirect()->to('siswa')->with('success', 'Data berhasil dihapus!');
        }
    }
}
