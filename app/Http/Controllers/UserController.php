<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class UserController extends Controller
{
    public function index()
    {
        $heroTitle = Setting::get('hero_title', 'SELAMAT DATANG DI RESTO KOKIKU');
        $heroSubtitle = Setting::get('hero_subtitle', 'Moslem Chinese Foods Halal');
        $heroText = Setting::get('hero_text', 'Nikmati cita rasa terbaik dengan pengalaman kuliner yang tak pernah terlupakan.');
        $heroTitleColor = Setting::get('hero_title_color', '#ffffff');
        $heroTitleWeight = Setting::get('hero_title_weight', '700');
        $heroTitleSize = Setting::get('hero_title_size', '56px');
        $heroSubtitleColor = Setting::get('hero_subtitle_color', '#ffffff');
        $heroSubtitleWeight = Setting::get('hero_subtitle_weight', '500');
        $heroSubtitleSize = Setting::get('hero_subtitle_size', '28px');
        $heroTextColor = Setting::get('hero_text_color', '#ffffff');
        $heroTextWeight = Setting::get('hero_text_weight', '400');
        $heroTextSize = Setting::get('hero_text_size', '20px');
        $heroBackgroundImage = Setting::get('hero_background_image', 'images/home_kokiku.jpeg');
        $aboutTitle = Setting::get('about_title', 'Tentang KOKIKU');
        $aboutTitleColor = Setting::get('about_title_color', '#111111');
        $aboutTitleWeight = Setting::get('about_title_weight', '700');
        $aboutTitleSize = Setting::get('about_title_size', '36px');
        $aboutParagraph1 = Setting::get('about_paragraph1', 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
        $aboutParagraph2 = Setting::get('about_paragraph2', 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
        $aboutParagraphColor = Setting::get('about_paragraph_color', '#333333');
        $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');
        $aboutParagraphSize = Setting::get('about_paragraph_size', '18px');

        return view('home', compact(
            'heroTitle',
            'heroSubtitle',
            'heroText',
            'heroTitleColor',
            'heroTitleWeight',
            'heroTitleSize',
            'heroSubtitleColor',
            'heroSubtitleWeight',
            'heroSubtitleSize',
            'heroTextColor',
            'heroTextWeight',
            'heroTextSize',
            'heroBackgroundImage',
            'aboutTitle',
            'aboutTitleColor',
            'aboutTitleWeight',
            'aboutTitleSize',
            'aboutParagraph1',
            'aboutParagraph2',
            'aboutParagraphColor',
            'aboutParagraphWeight',
            'aboutParagraphSize'
        ));
    }
}