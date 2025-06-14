# Al-Kurra School Management System

## English

Welcome to the Al-Kurra School Management System!  
This project is a web application built with Laravel, designed to manage classes, students, teachers, grades, attendance, and more for the Al-Kurra educational institution.

> **Note:** This project is still under development and is **not yet complete**.  
> There is currently **no license** applied to this project.

### Features

- User authentication and role-based access (Director, Teacher, Student)
- Class and student management
- Teacher assignment to classes
- Grade and attendance tracking
- Meeting management for classes
- PDF/Excel export for reports
- Registration requests and approval workflow
- Modern, responsive UI with Tailwind CSS and Livewire

### Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. Clone the repository:
   ```sh
   git clone <your-repo-url>
   cd Shkolla
   ```

2. Install PHP dependencies:
   ```sh
   composer install
   ```

3. Install JavaScript dependencies:
   ```sh
   npm install
   ```

4. Copy `.env.example` to `.env` and configure your environment variables.

5. Generate application key:
   ```sh
   php artisan key:generate
   ```

6. Run migrations:
   ```sh
   php artisan migrate
   ```

7. (Optional) Seed the database:
   ```sh
   php artisan db:seed
   ```

8. Start the development server:
   ```sh
   php artisan serve
   ```

9. Compile assets:
   ```sh
   npm run dev
   ```

### Usage

- Access the application at [http://localhost:8000](http://localhost:8000)
- Log in or register as a user.
- Directors can manage users, classes, and view statistics.
- Teachers can manage their classes, students, grades, and meetings.
- Students can view their class, grades, and attendance.

---

## Shqip

Mirë se vini në Sistemin e Menaxhimit të Shkollës Al-Kurra!  
Ky projekt është një aplikacion web i ndërtuar me Laravel, i dedikuar për menaxhimin e klasave, studentëve, mësuesve, notave, vijushmërisë dhe më shumë për institucionin arsimor Al-Kurra.

> **Shënim:** Ky projekt është ende në zhvillim dhe **nuk është i përfunduar**.  
> Aktualisht **nuk ka licencë** të aplikuar për këtë projekt.

### Karakteristikat

- Autentikim dhe menaxhim rolesh (Drejtor, Mësues, Student)
- Menaxhim i klasave dhe studentëve
- Caktimi i mësuesve në klasa
- Regjistrimi i notave dhe vijushmërisë
- Menaxhimi i takimeve për klasa
- Eksportimi i raporteve në PDF/Excel
- Kërkesa për regjistrim dhe procesi i aprovimit
- Ndërfaqe moderne dhe responsive me Tailwind CSS dhe Livewire

### Kërkesat

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL ose një bazë të dhënash të ngjashme

### Instalimi

1. Klononi projektin:
   ```sh
   git clone <adresa-e-repozitorit>
   cd Shkolla
   ```

2. Instaloni varësitë PHP:
   ```sh
   composer install
   ```

3. Instaloni varësitë JavaScript:
   ```sh
   npm install
   ```

4. Kopjoni `.env.example` në `.env` dhe konfiguroni variablat e mjedisit.

5. Gjeneroni çelësin e aplikacionit:
   ```sh
   php artisan key:generate
   ```

6. Ekzekutoni migrimet:
   ```sh
   php artisan migrate
   ```

7. (Opsionale) Mbillni të dhënat fillestare:
   ```sh
   php artisan db:seed
   ```

8. Startoni serverin zhvillues:
   ```sh
   php artisan serve
   ```

9. Kompiloni asetet:
   ```sh
   npm run dev
   ```

### Përdorimi

- Qasuni aplikacionit në [http://localhost:8000](http://localhost:8000)
- Hyni ose regjistrohuni si përdorues.
- Drejtori mund të menaxhojë përdoruesit, klasat dhe të shikojë statistikat.
- Mësuesit mund të menaxhojnë klasat, studentët, notat dhe takimet.
- Studentët mund të shikojnë klasën, notat dhe vijushmërinë e tyre.
