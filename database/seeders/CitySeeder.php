<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public $governorate = ['name_ar' => '', 'name_en' => '', 'id' => ''];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('cities');

        $cities = [
                    [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "15 مايو", "en" => "15 May"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الازبكية", "en" => "Al Azbakeyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "البساتين", "en" => "Al Basatin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "التبين", "en" => "Tebin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الخليفة", "en" => "El-Khalifa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الدراسة", "en" => "El darrasa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الدرب الاحمر", "en" => "Aldarb Alahmar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الزاوية الحمراء", "en" => "Zawya al-Hamra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الزيتون", "en" => "El-Zaytoun"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الساحل", "en" => "Sahel"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "السلام", "en" => "El Salam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "السيدة زينب", "en" => "Sayeda Zeinab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الشرابية", "en" => "El Sharabeya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مدينة الشروق", "en" => "Shorouk"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الظاهر", "en" => "El Daher"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "العتبة", "en" => "Ataba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "القاهرة الجديدة", "en" => "New Cairo"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المرج", "en" => "El Marg"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "عزبة النخل", "en" => "Ezbet el Nakhl"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المطرية", "en" => "Matareya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المعادى", "en" => "Maadi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المعصرة", "en" => "Maasara"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المقطم", "en" => "Mokattam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "المنيل", "en" => "Manyal"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الموسكى", "en" => "Mosky"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "النزهة", "en" => "Nozha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الوايلى", "en" => "Waily"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "باب الشعرية", "en" => "Bab al-Shereia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "بولاق", "en" => "Bolaq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "جاردن سيتى", "en" => "Garden City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "حدائق القبة", "en" => "Hadayek El-Kobba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "حلوان", "en" => "Helwan"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "دار السلام", "en" => "Dar Al Salam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "شبرا", "en" => "Shubra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "طره", "en" => "Tura"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "عابدين", "en" => "Abdeen"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "عباسية", "en" => "Abaseya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "عين شمس", "en" => "Ain Shams"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مدينة نصر", "en" => "Nasr City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مصر الجديدة", "en" => "New Heliopolis"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مصر القديمة", "en" => "Masr Al Qadima"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "منشية ناصر", "en" => "Mansheya Nasir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مدينة بدر", "en" => "Badr City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مدينة العبور", "en" => "Obour City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "وسط البلد", "en" => "Cairo Downtown"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الزمالك", "en" => "Zamalek"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "قصر النيل", "en" => "Kasr El Nile"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الرحاب", "en" => "Rehab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "القطامية", "en" => "Katameya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "مدينتي", "en" => "Madinty"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "روض الفرج", "en" => "Rod Alfarag"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "شيراتون", "en" => "Sheraton"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الجمالية", "en" => "El-Gamaleya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "العاشر من رمضان", "en" => "10th of Ramadan City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "الحلمية", "en" => "Helmeyat Alzaytoun"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "النزهة الجديدة", "en" => "New Nozha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القاهرة', 'Cairo'),
                        "name" => ["ar" => "العاصمة الإدارية", "en" => "Capital New"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الجيزة", "en" => "Giza"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "السادس من أكتوبر", "en" => "Sixth of October"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الشيخ زايد", "en" => "Cheikh Zayed"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الحوامدية", "en" => "Hawamdiyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "البدرشين", "en" => "Al Badrasheen"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الصف", "en" => "Saf"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "أطفيح", "en" => "Atfih"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "العياط", "en" => "Al Ayat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الباويطي", "en" => "Al-Bawaiti"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "منشأة القناطر", "en" => "ManshiyetAl Qanater"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "أوسيم", "en" => "Oaseem"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "كرداسة", "en" => "Kerdasa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "أبو النمرس", "en" => "Abu Nomros"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "كفر غطاطي", "en" => "Kafr Ghati"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "منشأة البكاري", "en" => "Manshiyet Al Bakari"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الدقى", "en" => "Dokki"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "العجوزة", "en" => "Agouza"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الهرم", "en" => "Haram"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الوراق", "en" => "Warraq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "امبابة", "en" => "Imbaba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "بولاق الدكرور", "en" => "Boulaq Dakrour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الواحات البحرية", "en" => "Al Wahat Al Baharia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "العمرانية", "en" => "Omraneya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "المنيب", "en" => "Moneeb"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "بين السرايات", "en" => "Bin Alsarayat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الكيت كات", "en" => "Kit Kat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "المهندسين", "en" => "Mohandessin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "فيصل", "en" => "Faisal"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "أبو رواش", "en" => "Abu Rawash"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "حدائق الأهرام", "en" => "Hadayek Alahram"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "الحرانية", "en" => "Haraneya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "حدائق اكتوبر", "en" => "Hadayek October"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "صفط اللبن", "en" => "Saft Allaban"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "القرية الذكية", "en" => "Smart Village"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الجيزة', 'Giza'),
                        "name" => ["ar" => "ارض اللواء", "en" => "Ard Ellwaa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "ابو قير", "en" => "Abu Qir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الابراهيمية", "en" => "Al Ibrahimeyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الأزاريطة", "en" => "Azarita"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الانفوشى", "en" => "Anfoushi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الدخيلة", "en" => "Dekheila"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "السيوف", "en" => "El Soyof"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "العامرية", "en" => "Ameria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "اللبان", "en" => "El Labban"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المفروزة", "en" => "Al Mafrouza"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المنتزه", "en" => "El Montaza"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المنشية", "en" => "Mansheya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الناصرية", "en" => "Naseria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "امبروزو", "en" => "Ambrozo"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "باب شرق", "en" => "Bab Sharq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "برج العرب", "en" => "Bourj Alarab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "ستانلى", "en" => "Stanley"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "سموحة", "en" => "Smouha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "سيدى بشر", "en" => "Sidi Bishr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "شدس", "en" => "Shads"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "غيط العنب", "en" => "Gheet Alenab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "فلمينج", "en" => "Fleming"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "فيكتوريا", "en" => "Victoria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "كامب شيزار", "en" => "Camp Shizar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "كرموز", "en" => "Karmooz"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "محطة الرمل", "en" => "Mahta Alraml"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "مينا البصل", "en" => "Mina El-Basal"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "العصافرة", "en" => "Asafra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "العجمي", "en" => "Agamy"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "بكوس", "en" => "Bakos"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "بولكلي", "en" => "Boulkly"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "كليوباترا", "en" => "Cleopatra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "جليم", "en" => "Glim"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المعمورة", "en" => "Al Mamurah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المندرة", "en" => "Al Mandara"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "محرم بك", "en" => "Moharam Bek"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الشاطبي", "en" => "Elshatby"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "سيدي جابر", "en" => "Sidi Gaber"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الساحل الشمالي", "en" => "North Coast\/sahel"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الحضرة", "en" => "Alhadra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "العطارين", "en" => "Alattarin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "سيدي كرير", "en" => "Sidi Kerir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "الجمرك", "en" => "Elgomrok"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "المكس", "en" => "Al Max"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأسكندرية', 'Alexandria'),
                        "name" => ["ar" => "مارينا", "en" => "Marina"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "المنصورة", "en" => "Mansoura"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "طلخا", "en" => "Talkha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "ميت غمر", "en" => "Mitt Ghamr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "دكرنس", "en" => "Dekernes"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "أجا", "en" => "Aga"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "منية النصر", "en" => "Menia El Nasr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "السنبلاوين", "en" => "Sinbillawin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "الكردي", "en" => "El Kurdi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "بني عبيد", "en" => "Bani Ubaid"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "المنزلة", "en" => "Al Manzala"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "تمي الأمديد", "en" => "tami al'amdid"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "الجمالية", "en" => "aljamalia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "شربين", "en" => "Sherbin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "المطرية", "en" => "Mataria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "بلقاس", "en" => "Belqas"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "ميت سلسيل", "en" => "Meet Salsil"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "جمصة", "en" => "Gamasa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "محلة دمنة", "en" => "Mahalat Damana"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الدقهلية', 'Dakahlia'),
                        "name" => ["ar" => "نبروه", "en" => "Nabroh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "الغردقة", "en" => "Hurghada"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "رأس غارب", "en" => "Ras Ghareb"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "سفاجا", "en" => "Safaga"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "القصير", "en" => "El Qusiar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "مرسى علم", "en" => "Marsa Alam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "الشلاتين", "en" => "Shalatin"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "حلايب", "en" => "Halaib"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحر الأحمر', 'Red Sea'),
                        "name" => ["ar" => "الدهار", "en" => "Aldahar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "دمنهور", "en" => "Damanhour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "كفر الدوار", "en" => "Kafr El Dawar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "رشيد", "en" => "Rashid"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "إدكو", "en" => "Edco"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "أبو المطامير", "en" => "Abu al-Matamir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "أبو حمص", "en" => "Abu Homs"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "الدلنجات", "en" => "Delengat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "المحمودية", "en" => "Mahmoudiyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "الرحمانية", "en" => "Rahmaniyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "إيتاي البارود", "en" => "Itai Baroud"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "حوش عيسى", "en" => "Housh Eissa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "شبراخيت", "en" => "Shubrakhit"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "كوم حمادة", "en" => "Kom Hamada"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "بدر", "en" => "Badr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "وادي النطرون", "en" => "Wadi Natrun"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "النوبارية الجديدة", "en" => "New Nubaria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('البحيرة', 'Beheira'),
                        "name" => ["ar" => "النوبارية", "en" => "Alnoubareya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "الفيوم", "en" => "Fayoum"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "الفيوم الجديدة", "en" => "Fayoum El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "طامية", "en" => "Tamiya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "سنورس", "en" => "Snores"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "إطسا", "en" => "Etsa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "إبشواي", "en" => "Epschway"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "يوسف الصديق", "en" => "Yusuf El Sediaq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "الحادقة", "en" => "Hadqa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "اطسا", "en" => "Atsa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "الجامعة", "en" => "Algamaa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الفيوم', 'Fayoum'),
                        "name" => ["ar" => "السيالة", "en" => "Sayala"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "طنطا", "en" => "Tanta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "المحلة الكبرى", "en" => "Al Mahalla Al Kobra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "كفر الزيات", "en" => "Kafr El Zayat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "زفتى", "en" => "Zefta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "السنطة", "en" => "El Santa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "قطور", "en" => "Qutour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "بسيون", "en" => "Basion"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الغربية', 'Gharbiya'),
                        "name" => ["ar" => "سمنود", "en" => "Samannoud"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "الإسماعيلية", "en" => "Ismailia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "فايد", "en" => "Fayed"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "القنطرة شرق", "en" => "Qantara Sharq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "القنطرة غرب", "en" => "Qantara Gharb"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "التل الكبير", "en" => "El Tal El Kabier"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "أبو صوير", "en" => "Abu Sawir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "القصاصين الجديدة", "en" => "Kasasien El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "نفيشة", "en" => "Nefesha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الإسماعلية', 'Ismailia'),
                        "name" => ["ar" => "الشيخ زايد", "en" => "Sheikh Zayed"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "شبين الكوم", "en" => "Shbeen El Koom"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "مدينة السادات", "en" => "Sadat City"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "منوف", "en" => "Menouf"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "سرس الليان", "en" => "Sars El-Layan"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "أشمون", "en" => "Ashmon"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "الباجور", "en" => "Al Bagor"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "قويسنا", "en" => "Quesna"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "بركة السبع", "en" => "Berkat El Saba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "تلا", "en" => "Tala"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنوفية', 'Menofia'),
                        "name" => ["ar" => "الشهداء", "en" => "Al Shohada"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "المنيا", "en" => "Minya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "المنيا الجديدة", "en" => "Minya El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "العدوة", "en" => "El Adwa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "مغاغة", "en" => "Magagha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "بني مزار", "en" => "Bani Mazar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "مطاي", "en" => "Mattay"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "سمالوط", "en" => "Samalut"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "المدينة الفكرية", "en" => "Madinat El Fekria"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "ملوي", "en" => "Meloy"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "دير مواس", "en" => "Deir Mawas"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "ابو قرقاص", "en" => "Abu Qurqas"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('المنيا', 'Minya'),
                        "name" => ["ar" => "ارض سلطان", "en" => "Ard Sultan"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "بنها", "en" => "Banha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "قليوب", "en" => "Qalyub"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "شبرا الخيمة", "en" => "Shubra Al Khaimah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "القناطر الخيرية", "en" => "Al Qanater Charity"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "الخانكة", "en" => "Khanka"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "كفر شكر", "en" => "Kafr Shukr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "طوخ", "en" => "Tukh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "قها", "en" => "Qaha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "العبور", "en" => "Obour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "الخصوص", "en" => "Khosous"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "شبين القناطر", "en" => "Shibin Al Qanater"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('القليوبية', 'Qaliubiya'),
                        "name" => ["ar" => "مسطرد", "en" => "Mostorod"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "الخارجة", "en" => "El Kharga"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "باريس", "en" => "Paris"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "موط", "en" => "Mout"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "الفرافرة", "en" => "Farafra"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "بلاط", "en" => "Balat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الوادي الجديد', 'New Valley'),
                        "name" => ["ar" => "الداخلة", "en" => "Dakhla"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('السويس', 'Suez'),
                        "name" => ["ar" => "السويس", "en" => "Suez"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('السويس', 'Suez'),
                        "name" => ["ar" => "الجناين", "en" => "Alganayen"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('السويس', 'Suez'),
                        "name" => ["ar" => "عتاقة", "en" => "Ataqah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('السويس', 'Suez'),
                        "name" => ["ar" => "العين السخنة", "en" => "Ain Sokhna"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('السويس', 'Suez'),
                        "name" => ["ar" => "فيصل", "en" => "Faysal"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "أسوان", "en" => "Aswan"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "أسوان الجديدة", "en" => "Aswan El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "دراو", "en" => "Drau"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "كوم أمبو", "en" => "Kom Ombo"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "نصر النوبة", "en" => "Nasr Al Nuba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "كلابشة", "en" => "Kalabsha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "إدفو", "en" => "Edfu"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "الرديسية", "en" => "Al-Radisiyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "البصيلية", "en" => "Al Basilia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "السباعية", "en" => "Al Sibaeia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "ابوسمبل السياحية", "en" => "Abo Simbl Al Siyahia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسوان', 'Aswan'),
                        "name" => ["ar" => "مرسى علم", "en" => "Marsa Alam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "أسيوط", "en" => "Assiut"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "أسيوط الجديدة", "en" => "Assiut El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "ديروط", "en" => "Dayrout"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "منفلوط", "en" => "Manfalut"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "القوصية", "en" => "Qusiya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "أبنوب", "en" => "Abnoub"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "أبو تيج", "en" => "Abu Tig"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "الغنايم", "en" => "El Ghanaim"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "ساحل سليم", "en" => "Sahel Selim"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "البداري", "en" => "El Badari"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('اسيوط', 'Assiut'),
                        "name" => ["ar" => "صدفا", "en" => "Sidfa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "بني سويف", "en" => "Bani Sweif"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "بني سويف الجديدة", "en" => "Beni Suef El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "الواسطى", "en" => "Al Wasta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "ناصر", "en" => "Naser"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "إهناسيا", "en" => "Ehnasia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "ببا", "en" => "beba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "الفشن", "en" => "Fashn"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "سمسطا", "en" => "Somasta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "الاباصيرى", "en" => "Alabbaseri"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بني سويف', 'Beni Suef'),
                        "name" => ["ar" => "مقبل", "en" => "Mokbel"]
                    ], [ // NOTE
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "بورسعيد", "en" => "PorSaid"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "بورفؤاد", "en" => "Port Fouad"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "العرب", "en" => "Alarab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "حى الزهور", "en" => "Zohour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "حى الشرق", "en" => "Alsharq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "حى الضواحى", "en" => "Aldawahi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "حى المناخ", "en" => "Almanakh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('بورسعيد', 'Port Said'),
                        "name" => ["ar" => "حى مبارك", "en" => "Mubarak"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "دمياط", "en" => "Damietta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "دمياط الجديدة", "en" => "New Damietta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "رأس البر", "en" => "Ras El Bar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "فارسكور", "en" => "Faraskour"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "الزرقا", "en" => "Zarqa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "السرو", "en" => "alsaru"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "الروضة", "en" => "alruwda"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "كفر البطيخ", "en" => "Kafr El-Batikh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "عزبة البرج", "en" => "Azbet Al Burg"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "ميت أبو غالب", "en" => "Meet Abou Ghalib"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('دمياط', 'Damietta'),
                        "name" => ["ar" => "كفر سعد", "en" => "Kafr Saad"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "الزقازيق", "en" => "Zagazig"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "العاشر من رمضان", "en" => "Al Ashr Men Ramadan"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "منيا القمح", "en" => "Minya Al Qamh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "بلبيس", "en" => "Belbeis"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "مشتول السوق", "en" => "Mashtoul El Souq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "القنايات", "en" => "Qenaiat"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "أبو حماد", "en" => "Abu Hammad"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "القرين", "en" => "El Qurain"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "ههيا", "en" => "Hehia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "أبو كبير", "en" => "Abu Kabir"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "فاقوس", "en" => "Faccus"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "الصالحية الجديدة", "en" => "El Salihia El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "الإبراهيمية", "en" => "Al Ibrahimiyah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "ديرب نجم", "en" => "Deirb Negm"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "كفر صقر", "en" => "Kafr Saqr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "أولاد صقر", "en" => "Awlad Saqr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "الحسينية", "en" => "Husseiniya"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "صان الحجر القبلية", "en" => "san alhajar alqablia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الشرقية', 'Sharkia'),
                        "name" => ["ar" => "منشأة أبو عمر", "en" => "Manshayat Abu Omar"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "الطور", "en" => "Al Toor"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "شرم الشيخ", "en" => "Sharm El-Shaikh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "دهب", "en" => "Dahab"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "نويبع", "en" => "Nuweiba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "طابا", "en" => "Taba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "سانت كاترين", "en" => "Saint Catherine"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "أبو رديس", "en" => "Abu Redis"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "أبو زنيمة", "en" => "Abu Zenaima"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('جنوب سيناء', 'South Sinai'),
                        "name" => ["ar" => "رأس سدر", "en" => "Ras Sidr"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "كفر الشيخ", "en" => "Kafr El Sheikh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "وسط البلد كفر الشيخ", "en" => "Kafr El Sheikh Downtown"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "دسوق", "en" => "Desouq"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "فوه", "en" => "Fooh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "مطوبس", "en" => "Metobas"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "برج البرلس", "en" => "Burg Al Burullus"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "بلطيم", "en" => "Baltim"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "مصيف بلطيم", "en" => "Masief Baltim"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "الحامول", "en" => "Hamol"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "بيلا", "en" => "Bella"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "الرياض", "en" => "Riyadh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "سيدي سالم", "en" => "Sidi Salm"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "قلين", "en" => "Qellen"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('كفر الشيخ', 'Kafr Al sheikh'),
                        "name" => ["ar" => "سيدي غازي", "en" => "Sidi Ghazi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "مرسى مطروح", "en" => "Marsa Matrouh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "الحمام", "en" => "El Hamam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "العلمين", "en" => "Alamein"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "الضبعة", "en" => "Dabaa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "النجيلة", "en" => "Al-Nagila"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "سيدي براني", "en" => "Sidi Brani"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "السلوم", "en" => "Salloum"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "سيوة", "en" => "Siwa"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "مارينا", "en" => "Marina"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('مطروح', 'Matrouh'),
                        "name" => ["ar" => "الساحل الشمالى", "en" => "North Coast"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "الأقصر", "en" => "Luxor"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "الأقصر الجديدة", "en" => "New Luxor"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "إسنا", "en" => "Esna"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "طيبة الجديدة", "en" => "New Tiba"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "الزينية", "en" => "Al ziynia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "البياضية", "en" => "Al Bayadieh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "القرنة", "en" => "Al Qarna"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "أرمنت", "en" => "Armant"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('الأقصر', 'Luxor'),
                        "name" => ["ar" => "الطود", "en" => "Al Tud"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "قنا", "en" => "Qena"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "قنا الجديدة", "en" => "New Qena"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "ابو طشت", "en" => "Abu Tesht"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "نجع حمادي", "en" => "Nag Hammadi"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "دشنا", "en" => "Deshna"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "الوقف", "en" => "Alwaqf"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "قفط", "en" => "Qaft"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "نقادة", "en" => "Naqada"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "فرشوط", "en" => "Farshout"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('قنا', 'Qena'),
                        "name" => ["ar" => "قوص", "en" => "Quos"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "العريش", "en" => "Arish"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "الشيخ زويد", "en" => "Sheikh Zowaid"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "نخل", "en" => "Nakhl"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "رفح", "en" => "Rafah"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "بئر العبد", "en" => "Bir al-Abed"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('شمال سيناء', 'North Sinai'),
                        "name" => ["ar" => "الحسنة", "en" => "Al Hasana"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "سوهاج", "en" => "Sohag"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "سوهاج الجديدة", "en" => "Sohag El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "أخميم", "en" => "Akhmeem"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "أخميم الجديدة", "en" => "Akhmim El Gedida"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "البلينا", "en" => "Albalina"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "المراغة", "en" => "El Maragha"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "المنشأة", "en" => "almunsha'a"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "دار السلام", "en" => "Dar AISalaam"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "جرجا", "en" => "Gerga"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "جهينة الغربية", "en" => "Jahina Al Gharbia"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "ساقلته", "en" => "Saqilatuh"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "طما", "en" => "Tama"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "طهطا", "en" => "Tahta"]
                    ], [
                        "governorate_id" => $this->getGovernorateID('سوهاج', 'Sohag'),
                        "name" => ["ar" => "الكوثر", "en" => "Alkawthar"],
                    ]
        ];

        foreach ($cities as $city) City::updateOrCreate([
            'name->ar' => $city['name']['ar'],
            'governorate_id' => $city['governorate_id']
        ], $city);
    }

    protected function getGovernorateID (string $name_ar, string $name_en) :int
    {
        if ($this->governorate['name_ar'] !== $name_ar && $this->governorate['name_en'] !== $name_en) {
            $row = Governorate::where('name->ar', 'LIKE', "%$name_ar%")->orWhere('name->en', 'LIKE', "%$name_en%")->first();
            $this->governorate['name_ar'] = $row->getTranslations('name')['ar'];
            $this->governorate['name_en'] = $row->getTranslations('name')['en'];
            $this->governorate['id'] = $row->id;
        }
        return $this->governorate['id'];
    }
}




