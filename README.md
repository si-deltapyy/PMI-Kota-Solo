<p align="center"><a href="https://pmisurakarta.or.id/" target="_blank"><img src="https://pmisurakarta.or.id/wp-content/uploads/2022/01/logo-PMI-Kota-Surakarta-300x85.jpg" alt="PMI Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About PMI KOTA SOLO

Palang Merah Indonesia (PMI) Kota Surakarta adalah satu dari lima PMI pelopor di Indonesia selain Surabaya, Yogyakarta, Semarang, dan Bandung.  Disebut pelopor karena kelima PMI cabang itulah yang berdiri tujuh bulan setelah PMI Pusat diresmikan pada 17 September 1945.

### VISI

Mewujudkan PMI yang profesional, berintegritas, dan bergerak bersama masyarakat

### MISI

1. Memelihara reputasi organisasi PMI di tingkat nasional dan internasional

2. Menjadi organisasi kemanusiaan terdepan yang memberikan layanan berkualitas kepada masyarakat sesuai dengan Prinsip-Prinsip Dasar Gerakan Palang Merah dan Bulan Sabit Merah Internasional

3. Meningkatkan integritas dan kemandirian organisasi melalui kerja sama strategis yang berkesinambungan dengan pemerintah, swasta, mitra gerakan, masyarakat, dan pemangku kepentingan lainnya di semua tingkatan PMI dengan mengutamakan keberpihakan kepada masyarakat yang memerlukan bantuan.

## Cara Clone Project Laravel

### Persyaratan

Sebelum memulai, pastikan perangkat lunak berikut telah terinstal di komputer Anda:

- [Git](https://git-scm.com/downloads)
- [PHP](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)

### Instalasi

1. **Clone Repositori**: Buka terminal atau command prompt dan jalankan perintah berikut untuk mengkloning repositori:

    ```bash
    git clone https://github.com/nisarizqi/PMI-Kota-Solo
    ```

2. **Konfigurasi Proyek**: Navigasikan ke direktori proyek dan salin file `.env.example` menjadi `.env`. Atur konfigurasi database dan pengaturan lainnya di dalam file `.env`.

   ```bash
   cp .env.example .env
   ```

4. **Instal Dependensi**: Jalankan perintah berikut untuk menginstal dependensi proyek:

    ```bash
    composer install
    ```

5. **Generate App Key**: Jalankan perintah berikut untuk menghasilkan kunci aplikasi baru:

    ```bash
    php artisan key:generate
    ```

6. **Migrasi Database**: Jika proyek menggunakan database, jalankan perintah berikut untuk menjalankan migrasi:

    ```bash
    php artisan migrate
    ```

7. **Mengisi Database**: Jalankan perintah ini untuk membuat data role

   ```bash
   php artisan db:seed AllSeeder 
   ```

8. **Jalankan Server**: Terakhir, jalankan server pengembangan Laravel dengan perintah:

    ```bash
    php artisan serve
    ```

    Proyek sekarang dapat diakses di [http://localhost:8000](http://localhost:8000).

<!-- - [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications. -->

<!-- ## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
