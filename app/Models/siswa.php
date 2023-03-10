<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// memetakan tabel database siswa pada database dengan menggunakan properti $table. 
// Dengan memetakan tabel database, 
// kita dapat melakukan operasi CRUD (Create, Read, Update, dan Delete) pada tabel tersebut menggunakan Model.
class siswa extends Model
{

    // mengindikasikan bahwa kelas ini menggunakan trait HasFactory yang 
    // menyediakan factory method untuk memudahkan pembuatan instance model.
    use HasFactory;
    // array kolom yang diizinkan untuk diisi 
    protected $fillable = ['nis', 'nama', 'jurusan', 'kelas', 'TTL', 'image'];
    protected $table = 'siswa';
    public $timestamps = false;
}
