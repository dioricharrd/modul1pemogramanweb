<?php

// Namespace untuk mengatur kelas dalam kelompok berbeda
namespace PemrogramanWebsite2024;

// Trait yang akan digunakan di dalam kelas
trait Pesan {
    public function tampilPesan() {
        return "Ini adalah pesan dari trait Pesan";
    }
}

// Abstract Class
abstract class Manusia {
    abstract public function pekerjaan();
}

// Kelas Orang menggunakan Abstract Class dan Trait
class Orang extends Manusia {
    // Property
    public $nama;
    public $umur;

    use Pesan; // Menggunakan trait

    // Constructor (Magic Method)
    public function __construct($nama, $umur) {
        $this->nama = $nama;
        $this->umur = $umur;
    }

    // Method pekerjaan diimplementasikan dari Abstract Class
    public function pekerjaan() {
        return "Mahasiswa";
    }

    // Method tambahan
    public function tampilkanInfo() {
        return "Nama : {$this->nama}<br>Umur : {$this->umur}<br>Pekerjaan : " . $this->pekerjaan();
    }
}

// Kelas Mahasiswa mewarisi (Inheritance) dari kelas Orang
class Mahasiswa extends Orang {
    public $jurusan;

    // Constructor
    public function __construct($nama, $umur, $jurusan) {
        parent::__construct($nama, $umur);
        $this->jurusan = $jurusan;
    }

    // Method untuk menampilkan jurusan
    public function tampilJurusan() {
        return "Jurusan : {$this->jurusan}";
    }
}

// Instansiasi objek
$mahasiswa = new Mahasiswa("Dio Richard", 20, "Teknik Informatika");
echo $mahasiswa->tampilkanInfo() . "<br>";
echo $mahasiswa->tampilJurusan() . "<br>";
echo $mahasiswa->tampilPesan();

?>
