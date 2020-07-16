# Lumen-Pusher [![Build Status](https://travis-ci.org/burhan-arifm/lumen-pusher.svg)](https://travis-ci.org/burhan-arifm/lumen-pusher) [![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Lumen-Pusher merupakan _web service_ sederhana berbasis JSON yang menggunakan _micro framework_ Lumen versi 7.2. aplikasi ini berfungsi semacam _database_ pengguna yang menyimpan nama, tanggal lahir, jenis kelamin, alamat, surel, dan pekerjaan. Selain itu, _web service_ ini juga memanfaatkan aplikasi pihak ketiga sebagai _server broadcasting_ Pusher yang berfungsi agar dapat memperbaharui tampilan di pengguna secara _real-time_.

## Apa itu Lumen?
Lumen merupakan _micro framework_ yang dikembangkan oleh Taylor Otwell yang juga merupakan pengembang framework Laravel. _Framework_ ini menggunakan bahasa PHP. Secara dasar, Lumen adalah Laravel dengan ukuran yang lebih ringan, karena terdapat beberapa fitur Laravel yang tidak dibawa oleh Lumen. Karena itu, Lumen dapat berjalan lebih cepat daripada Laravel.

## Spesifikasi kebutuhan
Karena aplikasi ini menggunakan _micro framework_ Lumen versi 7.2, maka spesifikasinya mengikuti kebutuhan dari framework itu sendiri. Sila menuju ke laman dokumentasi resminya [di sini](https://lumen.laravel.com/docs/7.x).

## Cara menggunakan
1. **_Clone_** repositori ini.
2. Jalankan `composer install`.
3. Jika pada folder tidak terdapat file **.env**, copy file **.env.example** di direktori yang sama kemudian ganti namanya menjadi **.env**.
4. Sesuaikan dengan setup pada komputernya, mulai dari _database_, URL aplikasi, hingga layanan _broadcast_ yang digunakan.

## Ingin memodifikasi sesuai kebutuhan?
Aplikasi ini menggunakan lisensi MIT. Apabila ingin memodifikasi aplikasinya, dipersilahkan. Adapun sebagai bantuan untuk memodifikasinya bisa menggunakan referensi-referensi berikut:
1. [Dokumentasi resmi _micro framework_ Lumen](https://lumen.laravel.com/docs/7.x).
2. [Tutorial menggunakan Pusher di framework Laravel](https://pusher.com/tutorials/realtime-table-laravel).
3. [Tutorial menggunakan Pusher di framework Laravel (**Bahasa Indonesia**)](https://medium.com/@ranggaantok/laravel-pusher-real-time-notification-e8a0012a25c3).
