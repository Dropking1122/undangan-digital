# AI Agent Prompt - Digital Invitation SaaS

## Role

Anda adalah Senior Software Architect dan Senior Laravel Developer.

Bangun aplikasi SaaS Undangan Digital modern menggunakan Laravel dan Livewire dengan arsitektur yang scalable, maintainable, dan production-ready.

---

# Tech Stack

Backend:

* Laravel 13

Frontend:

* Livewire
* Tailwind CSS

Admin Panel:

* Filament v4

Database:

* MySQL

Storage:

* Laravel Filesystem
* Cloudflare R2 Ready

Authentication:

* Laravel Breeze + Livewire

Payment:

* Midtrans (prepare integration)

Deployment:

* Docker Ready

---

# Project Goal

Membuat platform SaaS Undangan Digital yang memungkinkan pengguna:

1. Registrasi akun
2. Memilih template
3. Mengisi data undangan
4. Melihat preview real-time
5. Mengubah warna dan font
6. Upload foto
7. Upload musik
8. Mengaktifkan atau menonaktifkan section
9. Publish undangan
10. Membagikan link undangan

---

# Core Principles

IMPORTANT:

* Gunakan Service Pattern
* Gunakan Repository Pattern bila diperlukan
* Hindari Business Logic di Controller
* Gunakan Form Objects atau Actions
* Gunakan Livewire Components untuk Builder
* Gunakan Eloquent Relationships
* Gunakan UUID untuk public identifier
* Gunakan Soft Delete
* Semua kode harus clean dan reusable

---

# User Flow

Landing Page
→ Template Marketplace
→ Preview Template
→ Login/Register
→ Invitation Builder
→ Publish
→ Public Invitation Page

---

# Modules

## Authentication Module

Features:

* Login
* Register
* Forgot Password
* Google Login Ready

---

## Template Module

Template memiliki:

* name
* slug
* thumbnail
* category
* status

User dapat:

* melihat template
* preview template
* memilih template

---

## Invitation Module

Invitation memiliki:

* title
* slug
* template
* status

Status:

* draft
* published
* archived

---

# Invitation Data Structure

Gunakan JSON agar fleksibel.

Contoh:

{
"groom_name": "",
"bride_name": "",
"father_name": "",
"mother_name": "",
"event_date": "",
"event_time": "",
"location": "",
"maps_url": "",
"story": ""
}

JANGAN membuat puluhan kolom terpisah untuk setiap data undangan.

Gunakan JSON Cast.

---

# Theme System

Buat sistem tema yang fleksibel.

Theme Settings:

{
"primary_color": "#D4AF37",
"secondary_color": "#ffffff",
"font_heading": "Playfair Display",
"font_body": "Poppins",
"background_color": "#ffffff"
}

Preview harus berubah secara realtime menggunakan Livewire.

---

# Section System

Gunakan JSON.

Contoh:

{
"cover": true,
"couple": true,
"countdown": true,
"gallery": true,
"story": true,
"gift": true,
"rsvp": true,
"guestbook": true,
"video": false
}

Template harus dapat membaca konfigurasi ini secara dinamis.

---

# Gallery Module

Features:

* Multiple Upload
* Drag and Drop Sorting
* Delete Image
* Reorder Image

Storage:

storage/app/public/gallery

Gunakan Livewire Upload.

---

# Music Module

Features:

* Upload MP3
* Select Default Music
* Auto Play Setting
* Loop Setting

---

# RSVP Module

Guest dapat:

* Mengisi Nama
* Mengisi Kehadiran
* Menulis Pesan

Data tersimpan ke database.

---

# Guest Book Module

Guest dapat:

* Menulis Ucapan

Owner dapat melihat daftar ucapan.

---

# Digital Gift Module

Support:

* Bank Account
* DANA
* OVO
* GoPay
* ShopeePay

Data dapat ditampilkan atau disembunyikan.

---

# Builder Module

Buat Livewire Builder Layout.

Layout:

Sidebar Left:

* Event Information
* Couple Information
* Gallery
* Story
* Theme
* Music
* RSVP
* Gift

Main Area:

* Live Preview

Perubahan harus realtime tanpa reload.

Gunakan wire:model.live.

---

# Template Engine

Template berada pada:

resources/views/themes

Contoh:

themes/
├── elegant-gold
├── minimalist
├── luxury
├── rustic

Setiap template memiliki:

* cover.blade.php
* couple.blade.php
* gallery.blade.php
* event.blade.php
* footer.blade.php

Template harus modular.

---

# Public Invitation

URL:

/{slug}

Contoh:

/revaldi-siti

Features:

* Cover
* Open Invitation Button
* Music
* Countdown
* Couple Section
* Story Section
* Gallery Section
* Event Section
* Maps Section
* RSVP Section
* Guest Book
* Gift Section

---

# Guest Name Feature

Support query parameter:

?to=Nama Tamu

Contoh:

/revaldi-siti?to=Bapak Ahmad

Tampilkan:

Kepada Yth.
Bapak Ahmad

---

# Subscription System

Plans:

Basic
Premium
Business

Buat struktur database dan service untuk subscription walaupun payment belum diimplementasikan.

---

# Admin Panel

Gunakan Filament.

Resources:

* Users
* Templates
* Categories
* Plans
* Invitations
* Payments
* Settings

---

# Database Design

Generate migration lengkap.

Gunakan:

* foreign key
* indexing
* soft delete
* timestamps

---

# API Ready

Pisahkan business logic agar nantinya mudah membuat:

* Mobile App
* REST API
* Public API

---

# Code Quality

Wajib:

* Type Hinting
* PHPStan Friendly
* PSR-12
* Laravel Pint
* Clean Architecture
* Feature Tests

---

# Final Output

Buat project secara bertahap:

Phase 1:

* Migration
* Models
* Relationships

Phase 2:

* Authentication

Phase 3:

* Template Module

Phase 4:

* Invitation Builder

Phase 5:

* Public Invitation

Phase 6:

* Admin Panel

Phase 7:

* Subscription System

Phase 8:

* Testing

Setiap phase harus menghasilkan kode lengkap, migration, model, service, livewire component, filament resource, route, dan dokumentasi implementasi.
