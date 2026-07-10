<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>KOKIKU</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
scroll-behavior:smooth;
}

body{
font-family:'Segoe UI',sans-serif;
overflow-x:hidden;
}

/* Navbar */

.navbar{
background:#c1121f !important;
}

.navbar-brand{
font-size:28px;
font-weight:bold;
color:#ffc107 !important;
}

.navbar .nav-link{
color:#fff !important;
font-weight:100;
font-size:18px;
transition:all 0.3s ease;
display:inline-block;
}

.navbar .nav-link.active{
    transform:scale(1.12);
    color:#ffd54f !important;
}

.navbar-nav .profile-item {
    margin-left: 0.5rem;
}

.profile-link {
    width: 28px;
    height: 28px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.profile-icon {
    width: 24px;
    height: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff;
    color: #111;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.5);
}

.profile-icon svg {
    width: 14px;
    height: 14px;
    display: block;
}

.profile-item .dropdown-toggle::after {
    display: none;
}

.profile-text {
    display: block;
    font-size: 11px;
    line-height: 1.1;
    margin-top: 2px;
    color: rgba(255, 255, 255, 0.94);
    letter-spacing: 0.02em;
}

.profile-link {
    flex-direction: column;
}

/* Hero */

.hero{
height:100vh;
background:
linear-gradient(rgba(0,0,0,.6),
rgba(0,0,0,.6)),
url('{{ asset($heroBackgroundImage ?? 'images/home_kokiku.jpeg') }}');
background-size:cover;
background-position:center;
display:flex;
justify-content:center;
align-items:center;
text-align:center;
color:white;
}

.hero h1{
font-size:60px;
font-weight:bold;
}

.hero p{
font-size:22px;
}

.btn-kokiku{
background:#ffc107;
color:black;
font-weight:bold;
padding:12px 30px;
border:none;
border-radius:30px;
transition:.3s;
}

.btn-kokiku:hover{
transform:scale(1.05);
}

/* About */

.section-title{
text-align:center;
margin-bottom:40px;
font-weight:bold;
}

.about{
padding:80px 0;
}

/* Menu */

.menu{
background:#f8f9fa;
padding:80px 0;
}

.card{
border:none;
overflow:hidden;
border-radius:20px;
transition:.3s;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.card:hover{
transform:translateY(-10px);
}

.card img{
height:250px;
object-fit:cover;
}

/* Gallery */

.gallery{
padding:80px 0;
}

.gallery img{
width:100%;
height:250px;
object-fit:cover;
border-radius:15px;
transition:.3s;
}

.gallery img:hover{
transform:scale(1.05);
}

/* Contact */

.contact{
background:#f8f9fa;
padding:80px 0;
}

.contact-box{
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

/* Footer */

footer{
background:#111;
color:white; 
margin-bottom:5px;
padding:5px 0;
text-align:center;
}

/* Responsive */

@media(max-width:768px){

.hero h1{
font-size:35px;
}

.hero p{
font-size:18px;
}

}

.contact h4,
.contact h5{
    color:#ffc107;
    font-weight:bold;
    text-shadow:0 0 8px rgba(255,193,7,0.3);
}

</style>

</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">

<div class="container">

<a class="navbar-brand" href="#">
KOKIKU
</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

@php
    $avatarUrl = auth()->check()
        ? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(auth()->user()->email))) . '?s=128&d=identicon'
        : 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png';
@endphp

<li class="nav-item">
<a class="nav-link" href="#about">Tentang</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#menu-kami">Menu</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#gallery">Galeri</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#contact">Kontak</a>
</li>

@if(auth()->check())
<li class="nav-item dropdown profile-item">
    <a class="nav-link dropdown-toggle profile-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="profile-icon">
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12.5C10.07 12.5 8.5 10.93 8.5 9C8.5 7.07 10.07 5.5 12 5.5C13.93 5.5 15.5 7.07 15.5 9C15.5 10.93 13.93 12.5 12 12.5ZM12 14.5C14.97 14.5 18 15.97 18 17.5V18.5H6V17.5C6 15.97 9.03 14.5 12 14.5Z"/>
            </svg>
        </span>
        <span class="profile-text">Profil</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-item-text">
            <strong>{{ auth()->user()->name }}</strong>
        </li>
        <li class="dropdown-item-text text-muted">
            {{ ucfirst(auth()->user()->role) }}
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item" href="{{ url('/user') }}">Profil Saya</a>
        </li>
        @if(auth()->user()->role === 'admin')
        <li>
            <a class="dropdown-item" href="{{ url('/admin') }}">Dashboard Admin</a>
        </li>
        @endif
        <li>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</li>
@endif

</ul>

</div>

</div>

</nav>

<!-- Hero -->

<section class="hero" id="home">

<div>

<h2 style="color: {{ $heroTitleColor ?? '#ffffff' }}; font-weight: {{ $heroTitleWeight ?? '700' }}; font-size: {{ $heroTitleSize ?? '56px' }};">
{{ $heroTitle ?? 'SELAMAT DATANG DI RESTO KOKIKU' }}
</h2>
<h4 style="color: {{ $heroSubtitleColor ?? '#ffffff' }}; font-weight: {{ $heroSubtitleWeight ?? '500' }}; font-size: {{ $heroSubtitleSize ?? '28px' }}; margin-top: 1rem;">
{{ $heroSubtitle ?? 'Moslem Chinese Foods Halal' }}
</h4>

<p style="color: {{ $heroTextColor ?? '#ffffff' }}; font-weight: {{ $heroTextWeight ?? '400' }}; font-size: {{ $heroTextSize ?? '20px' }}; margin-top: 1rem;">
{{ $heroText ?? 'Nikmati cita rasa terbaik dengan pengalaman kuliner yang tak pernah terlupakan.' }}
</p>

</div>

</section>

<!-- About -->

<section class="about" id="about">

<div class="container">

<h2 class="section-title" style="color: {{ $aboutTitleColor ?? '#111111' }}; font-weight: {{ $aboutTitleWeight ?? '700' }}; font-size: {{ $aboutTitleSize ?? '36px' }};">
{{ $aboutTitle ?? 'Tentang KOKIKU' }}
</h2>

<div class="row align-items-center">

<div class="col-md-6">

<img
src="https://images.unsplash.com/photo-1552566626-52f8b828add9"
class="img-fluid rounded">

</div>

<div class="col-md-6">

<p style="color: {{ $aboutParagraphColor ?? '#333333' }}; font-weight: {{ $aboutParagraphWeight ?? '400' }}; font-size: {{ $aboutParagraphSize ?? '18px' }};">
{{ $aboutParagraph1 ?? 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.' }}
</p>

<p style="color: {{ $aboutParagraphColor ?? '#333333' }}; font-weight: {{ $aboutParagraphWeight ?? '400' }}; font-size: {{ $aboutParagraphSize ?? '18px' }};">
{{ $aboutParagraph2 ?? 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.' }}
</p>

</div>

</div>

</div>

</section>

<!-- Menu -->

<section class="menu" id="menu-kami">

<div class="container">

<h2 class="section-title">
Menu Favorit
</h2>

<div class="row g-4">

<div class="col-md-4">
<div class="card">

<img src="https://images.unsplash.com/photo-1604908554165-e7c3d31c89c4">

<div class="card-body">

<h4>Nasi Goreng Spesial</h4>

<p>Rp 25.000</p>

</div>

</div>
</div>

<div class="col-md-4">
<div class="card">

<img src="https://images.unsplash.com/photo-1529042410759-befb1204b468">

<div class="card-body">

<h4>Sate Ayam</h4>

<p>Rp 30.000</p>

</div>

</div>
</div>

<div class="col-md-4">
<div class="card">

<img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">

<div class="card-body">

<h4>Ayam Bakar Madu</h4>

<p>Rp 35.000</p>

</div>

</div>
</div>

</div>

</div>

</section>

<!-- Gallery -->

<section class="gallery" id="gallery">

<div class="container">

<h2 class="section-title">
Galeri Resto
</h2>

<div class="row g-4">

<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4">
</div>

<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1559339352-11d035aa65de">
</div>

<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0">
</div>

</div>

</div>

</section>

<!-- Contact -->

<section class="contact" id="contact">

<div class="container">

<h2 class="section-title">
Kontak Kami
</h2>

<div class="contact-box text-center">

<h4>KOKIKU</h4>
<h5>Moslem Chinese Foods</h5>

<p>
<i class="fa-solid fa-location-dot"></i>
Jl. Kuliner Nusantara No.88
</p>

<p>
<i class="fa-solid fa-phone"></i>
0812-3456-7890
</p>

<p>
<i class="fa-solid fa-envelope"></i>
info@kokiku.com
</p>

</div>

</div>

</section>

<!-- Footer -->

<footer>

<h5>CHINESE FOODS HALAL</h5>

<p>
2026 All Rights Reserved
</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

// Animasi navbar

window.addEventListener('scroll', function(){

const navbar =
document.querySelector('.navbar');

if(window.scrollY > 50){

navbar.style.background='#000';

}else{

navbar.style.background='#111';

}

});

</script>
<script>
const navLinks = document.querySelectorAll('.nav-link');

navLinks.forEach(link => {
    link.addEventListener('click', function() {
        navLinks.forEach(item => item.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>
</body>
</html>