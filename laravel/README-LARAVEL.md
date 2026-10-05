# Desa Jalatrang — Laravel

Salin seluruh isi folder ini ke dalam project Laravel Anda (merge, timpa jika diminta).

Langkah lengkap ada di jawaban chat. Ringkasnya:

1. composer create-project laravel/laravel jalatrang
2. Buat database `jalatrang`, atur .env (DB_CONNECTION=mysql, dst.)
3. Salin folder ini ke project, pindahkan vendor/ & assets/ lama ke public/
4. php artisan migrate --seed
5. npm install && npm run dev
6. php artisan serve  →  http://127.0.0.1:8000/berita
