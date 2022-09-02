### Simple CRUD Jenis Hewan,Ras Hewan dan  Postingan Pengadopsian

---

#### Penjelasan Project

Project ini adalah project Simple CRUD yang bisa mengotorasi manajemen data Jenis Hewan,Ras Hewan dan Postingan Pengadopsian. Project ini terinsipirasi dari project tugas akhir D3 yang sudah penulis kerjakan dan selesaikan dengan judul [Hewan Siapa](https://github.com/daffaraka/Hewan-Siapa) .
Dalam project ini, penulis memakai Framework Laravel 8 , serta memakai panel admin Ample Dashboard .

___
#### Fitur Project

 * CRUD Jenis Hewan
 * CRUD Ras Hewan 
 * CRUD Post Adopsi
 * Authentication (login,logout dan register )
 * Admin Dashboard
 * Live Search menggunakan Ajax

___

#### Desain Database 

<img src="public/desain db/desain db.png">

Penjelasan : 

* Jenis Hewan - Ras Hewan
Jenis Hewan digambarkan sebagai Parents dari Ras Hewan. Ras Hewan tidak akan bisa dibuat jika tidak terdapat data jenis hewan. Relasi yang dibuat menggunakan foreign key pada tabel **ras_hewan** dengan field **id_jenis_hewan** dengan property onUpdate dan onDelete **cacade**  

<br>

* RasHewan dan PostAdopsi
Ras Hewan  digambarkan sebagai Parents dari PostAdopsi. PostAdopsi tidak akan bisa dibuat jika tidak terdapat data ras hewan . Relasi yang dibuat menggunakan foreign key pada tabel **post_adopsi** dengan field **id_ras_hewan** dengan property onUpdate dan onDelete **cacade**  


___
#### Screenshot aplikasi

1. Jenis Hewan
<img src="public/ss aplikasi/jenis hewan.png">
1. Ras Hewan
<img src="public/ss aplikasi/ras hewan.png">
1. Post Adopsi
<img src="public/ss aplikasi/post adopsi.png">
1. Login
<img src="public/ss aplikasi/login.png">
1. Contoh Pencarian
<img src="public/ss aplikasi/post adopsi cari.png">

---

#### Dependency

 * Laravel 8 
 * Bootstrap
 * PHP 7++



