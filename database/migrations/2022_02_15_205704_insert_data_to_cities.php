<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertDataToCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('cities', function (Blueprint $table) {
        //     //
        // });

        DB::table('cities')->insert(
            [
                /* Start Cairo ID:1 */
                ['governorate_id' => 1, 'city_name_ar' => 'مايو',  'city_name_en' =>  'May 15'],
                ['governorate_id' => 1, 'city_name_ar' => 'الازبكية', 'city_name_en' => 'Al Azbakeyah'],
                ['governorate_id' => 1, 'city_name_ar' => 'البساتين', 'city_name_en' => 'Al Basatin'],
                ['governorate_id' => 1, 'city_name_ar' => 'التبين', 'city_name_en' => 'Tebin'],
                ['governorate_id' => 1, 'city_name_ar' => 'الخليفة', 'city_name_en' => 'El-Khalifa'],
                ['governorate_id' => 1, 'city_name_ar' => 'الدراسة', 'city_name_en' => 'El darrasa'],
                ['governorate_id' => 1, 'city_name_ar' => 'الدرب الاحمر', 'city_name_en' => 'Aldarb Alahmar'],
                ['governorate_id' => 1, 'city_name_ar' => 'الزاوية الحمراء', 'city_name_en' => 'Zawya al-Hamra'],
                ['governorate_id' => 1, 'city_name_ar' => 'الزيتون', 'city_name_en' => 'El-Zaytoun'],
                ['governorate_id' => 1, 'city_name_ar' => 'الساحل', 'city_name_en' => 'Sahel'],
                ['governorate_id' => 1, 'city_name_ar' => 'السلام', 'city_name_en' => 'El Salam'],
                ['governorate_id' => 1, 'city_name_ar' => 'السيدة زينب', 'city_name_en' => 'Sayeda Zeinab'],
                ['governorate_id' => 1, 'city_name_ar' => 'الشرابية', 'city_name_en' => 'El Sharabeya'],
                ['governorate_id' => 1, 'city_name_ar' => 'مدينة الشروق', 'city_name_en' => 'Shorouk'],
                ['governorate_id' => 1, 'city_name_ar' => 'الظاهر', 'city_name_en' => 'El Daher'],
                ['governorate_id' => 1, 'city_name_ar' => 'العتبة', 'city_name_en' => 'Ataba'],
                ['governorate_id' => 1, 'city_name_ar' => 'القاهرة الجديدة', 'city_name_en' => 'New Cairo'],
                ['governorate_id' => 1, 'city_name_ar' => 'المرج', 'city_name_en' => 'El Marg'],
                ['governorate_id' => 1, 'city_name_ar' => 'عزبة النخل', 'city_name_en' => 'Ezbet el Nakhl'],
                ['governorate_id' => 1, 'city_name_ar' => 'المطرية', 'city_name_en' => 'Matareya'],
                ['governorate_id' => 1, 'city_name_ar' => 'المعادى', 'city_name_en' => 'Maadi'],
                ['governorate_id' => 1, 'city_name_ar' => 'المعصرة', 'city_name_en' => 'Maasara'],
                ['governorate_id' => 1, 'city_name_ar' => 'المقطم', 'city_name_en' => 'Mokattam'],
                ['governorate_id' => 1, 'city_name_ar' => 'المنيل', 'city_name_en' => 'Manyal'],
                ['governorate_id' => 1, 'city_name_ar' => 'الموسكى', 'city_name_en' => 'Mosky'],
                ['governorate_id' => 1, 'city_name_ar' => 'النزهة', 'city_name_en' => 'Nozha'],
                ['governorate_id' => 1, 'city_name_ar' => 'الوايلى', 'city_name_en' => 'Waily'],
                ['governorate_id' => 1, 'city_name_ar' => 'باب الشعرية', 'city_name_en' => 'Bab al-Shereia'],
                ['governorate_id' => 1, 'city_name_ar' => 'بولاق', 'city_name_en' => 'Bolaq'],
                ['governorate_id' => 1, 'city_name_ar' => 'جاردن سيتى', 'city_name_en' => 'Garden City'],
                ['governorate_id' => 1, 'city_name_ar' => 'حدائق القبة', 'city_name_en' => 'Hadayek El-Kobba'],
                ['governorate_id' => 1, 'city_name_ar' => 'حلوان', 'city_name_en' => 'Helwan'],
                ['governorate_id' => 1, 'city_name_ar' => 'دار السلام', 'city_name_en' => 'Dar Al Salam'],
                ['governorate_id' => 1, 'city_name_ar' => 'شبرا', 'city_name_en' => 'Shubra'],
                ['governorate_id' => 1, 'city_name_ar' => 'طره', 'city_name_en' => 'Tura'],
                ['governorate_id' => 1, 'city_name_ar' => 'عابدين', 'city_name_en' => 'Abdeen'],
                ['governorate_id' => 1, 'city_name_ar' => 'عباسية', 'city_name_en' => 'Abaseya'],
                ['governorate_id' => 1, 'city_name_ar' => 'عين شمس', 'city_name_en' => 'Ain Shams'],
                ['governorate_id' => 1, 'city_name_ar' => 'مدينة نصر', 'city_name_en' => 'Nasr City'],
                ['governorate_id' => 1, 'city_name_ar' => 'مصر الجديدة', 'city_name_en' => 'New Heliopolis'],
                ['governorate_id' => 1, 'city_name_ar' => 'مصر القديمة', 'city_name_en' => 'Masr Al Qadima'],
                ['governorate_id' => 1, 'city_name_ar' => 'منشية ناصر', 'city_name_en' => 'Mansheya Nasir'],
                ['governorate_id' => 1, 'city_name_ar' => 'مدينة بدر', 'city_name_en' => 'Badr City'],
                ['governorate_id' => 1, 'city_name_ar' => 'مدينة العبور', 'city_name_en' => 'Obour City'],
                ['governorate_id' => 1, 'city_name_ar' => 'وسط البلد', 'city_name_en' => 'Cairo Downtown'],
                ['governorate_id' => 1, 'city_name_ar' => 'الزمالك', 'city_name_en' => 'Zamalek'],
                ['governorate_id' => 1, 'city_name_ar' => 'قصر النيل', 'city_name_en' => 'Kasr El Nile'],
                ['governorate_id' => 1, 'city_name_ar' => 'الرحاب', 'city_name_en' => 'Rehab'],
                ['governorate_id' => 1, 'city_name_ar' => 'القطامية', 'city_name_en' => 'Katameya'],
                ['governorate_id' => 1, 'city_name_ar' => 'مدينتي', 'city_name_en' => 'Madinty'],
                ['governorate_id' => 1, 'city_name_ar' => 'روض الفرج', 'city_name_en' => 'Rod Alfarag'],
                ['governorate_id' => 1, 'city_name_ar' => 'شيراتون', 'city_name_en' => 'Sheraton'],
                ['governorate_id' => 1, 'city_name_ar' => 'الجمالية', 'city_name_en' => 'El-Gamaleya'],
                ['governorate_id' => 1, 'city_name_ar' => 'العاشر من رمضان', 'city_name_en' => 'th of Ramadan City'],
                ['governorate_id' => 1, 'city_name_ar' => 'الحلمية', 'city_name_en' => 'Helmeyat Alzaytoun'],
                ['governorate_id' => 1, 'city_name_ar' => 'النزهة الجديدة', 'city_name_en' => 'New Nozha'],
                ['governorate_id' => 1, 'city_name_ar' => 'العاصمة الإدارية', 'city_name_en' => 'Capital New'],
                /* End Cairo ID:1 */

                /* Start Giza ID:2 */
                ['governorate_id' => 2,  'city_name_ar' => 'الجيزة', 'city_name_en' => 'Giza'],
                ['governorate_id' => 2,  'city_name_ar' => 'السادس من أكتوبر', 'city_name_en' => 'Sixth of October'],
                ['governorate_id' => 2,  'city_name_ar' => 'الشيخ زايد', 'city_name_en' => 'Cheikh Zayed'],
                ['governorate_id' => 2,  'city_name_ar' => 'الحوامدية', 'city_name_en' => 'Hawamdiyah'],
                ['governorate_id' => 2,  'city_name_ar' => 'البدرشين', 'city_name_en' => 'Al Badrasheen'],
                ['governorate_id' => 2,  'city_name_ar' => 'الصف', 'city_name_en' => 'Saf'],
                ['governorate_id' => 2,  'city_name_ar' => 'أطفيح', 'city_name_en' => 'Atfih'],
                ['governorate_id' => 2,  'city_name_ar' => 'العياط', 'city_name_en' => 'Al Ayat'],
                ['governorate_id' => 2,  'city_name_ar' => 'الباويطي', 'city_name_en' => 'Al-Bawaiti'],
                ['governorate_id' => 2,  'city_name_ar' => 'منشأة القناطر', 'city_name_en' => 'ManshiyetAl Qanater'],
                ['governorate_id' => 2,  'city_name_ar' => 'أوسيم', 'city_name_en' => 'Oaseem'],
                ['governorate_id' => 2,  'city_name_ar' => 'كرداسة', 'city_name_en' => 'Kerdasa'],
                ['governorate_id' => 2,  'city_name_ar' => 'أبو النمرس', 'city_name_en' => 'Abu Nomros'],
                ['governorate_id' => 2,  'city_name_ar' => 'كفر غطاطي', 'city_name_en' => 'Kafr Ghati'],
                ['governorate_id' => 2,  'city_name_ar' => 'منشأة البكاري', 'city_name_en' => 'Manshiyet Al Bakari'],
                ['governorate_id' => 2,  'city_name_ar' => 'الدقى', 'city_name_en' => 'Dokki'],
                ['governorate_id' => 2,  'city_name_ar' => 'العجوزة', 'city_name_en' => 'Agouza'],
                ['governorate_id' => 2,  'city_name_ar' => 'الهرم', 'city_name_en' => 'Haram'],
                ['governorate_id' => 2,  'city_name_ar' => 'الوراق', 'city_name_en' => 'Warraq'],
                ['governorate_id' => 2,  'city_name_ar' => 'امبابة', 'city_name_en' => 'Imbaba'],
                ['governorate_id' => 2,  'city_name_ar' => 'بولاق الدكرور', 'city_name_en' => 'Boulaq Dakrour'],
                ['governorate_id' => 2,  'city_name_ar' => 'الواحات البحرية', 'city_name_en' => 'Al Wahat Al Baharia'],
                ['governorate_id' => 2,  'city_name_ar' => 'العمرانية', 'city_name_en' => 'Omraneya'],
                ['governorate_id' => 2,  'city_name_ar' => 'المنيب', 'city_name_en' => 'Moneeb'],
                ['governorate_id' => 2,  'city_name_ar' => 'بين السرايات', 'city_name_en' => 'Bin Alsarayat'],
                ['governorate_id' => 2,  'city_name_ar' => 'الكيت كات', 'city_name_en' => 'Kit Kat'],
                ['governorate_id' => 2,  'city_name_ar' => 'المهندسين', 'city_name_en' => 'Mohandessin'],
                ['governorate_id' => 2,  'city_name_ar' => 'فيصل', 'city_name_en' => 'Faisal'],
                ['governorate_id' => 2,  'city_name_ar' => 'أبو رواش', 'city_name_en' => 'Abu Rawash'],
                ['governorate_id' => 2,  'city_name_ar' => 'حدائق الأهرام', 'city_name_en' => 'Hadayek Alahram'],
                ['governorate_id' => 2,  'city_name_ar' => 'الحرانية', 'city_name_en' => 'Haraneya'],
                ['governorate_id' => 2,  'city_name_ar' => 'حدائق اكتوبر', 'city_name_en' => 'Hadayek October'],
                ['governorate_id' => 2,  'city_name_ar' => 'صفط اللبن', 'city_name_en' => 'Saft Allaban'],
                ['governorate_id' => 2,  'city_name_ar' => 'القرية الذكية', 'city_name_en' => 'Smart Village'],
                ['governorate_id' => 2,  'city_name_ar' => 'ارض اللواء', 'city_name_en' => 'Ard Ellwaa'],
                /* End Giza ID:2 */

                /* Start Alexandria ID:3  */
                ['governorate_id' => 3,  'city_name_ar' => 'ابو قير', 'city_name_en' => 'Abu Qir'],
                ['governorate_id' => 3,  'city_name_ar' => 'الابراهيمية', 'city_name_en' => 'Al Ibrahimeyah'],
                ['governorate_id' => 3,  'city_name_ar' => 'الأزاريطة', 'city_name_en' => 'Azarita'],
                ['governorate_id' => 3,  'city_name_ar' => 'الانفوشى', 'city_name_en' => 'Anfoushi'],
                ['governorate_id' => 3,  'city_name_ar' => 'الدخيلة', 'city_name_en' => 'Dekheila'],
                ['governorate_id' => 3,  'city_name_ar' => 'السيوف', 'city_name_en' => 'El Soyof'],
                ['governorate_id' => 3,  'city_name_ar' => 'العامرية', 'city_name_en' => 'Ameria'],
                ['governorate_id' => 3,  'city_name_ar' => 'اللبان', 'city_name_en' => 'El Labban'],
                ['governorate_id' => 3,  'city_name_ar' => 'المفروزة', 'city_name_en' => 'Al Mafrouza'],
                ['governorate_id' => 3,  'city_name_ar' => 'المنتزه', 'city_name_en' => 'El Montaza'],
                ['governorate_id' => 3,  'city_name_ar' => 'المنشية', 'city_name_en' => 'Mansheya'],
                ['governorate_id' => 3,  'city_name_ar' => 'الناصرية', 'city_name_en' => 'Naseria'],
                ['governorate_id' => 3,  'city_name_ar' => 'امبروزو', 'city_name_en' => 'Ambrozo'],
                ['governorate_id' => 3,  'city_name_ar' => 'باب شرق', 'city_name_en' => 'Bab Sharq'],
                ['governorate_id' => 3,  'city_name_ar' => 'برج العرب', 'city_name_en' => 'Bourj Alarab'],
                ['governorate_id' => 3,  'city_name_ar' => 'ستانلى', 'city_name_en' => 'Stanley'],
                ['governorate_id' => 3,  'city_name_ar' => 'سموحة', 'city_name_en' => 'Smouha'],
                ['governorate_id' => 3,  'city_name_ar' => 'سيدى بشر', 'city_name_en' => 'Sidi Bishr'],
                ['governorate_id' => 3,  'city_name_ar' => 'شدس', 'city_name_en' => 'Shads'],
                ['governorate_id' => 3,  'city_name_ar' => 'غيط العنب', 'city_name_en' => 'Gheet Alenab'],
                ['governorate_id' => 3,  'city_name_ar' => 'فلمينج', 'city_name_en' => 'Fleming'],
                ['governorate_id' => 3,  'city_name_ar' => 'فيكتوريا', 'city_name_en' => 'Victoria'],
                ['governorate_id' => 3,  'city_name_ar' => 'كامب شيزار', 'city_name_en' => 'Camp Shizar'],
                ['governorate_id' => 3,  'city_name_ar' => 'كرموز', 'city_name_en' => 'Karmooz'],
                ['governorate_id' => 3,  'city_name_ar' => 'محطة الرمل', 'city_name_en' => 'Mahta Alraml'],
                ['governorate_id' => 3,  'city_name_ar' => 'مينا البصل', 'city_name_en' => 'Mina El-Basal'],
                ['governorate_id' => 3,  'city_name_ar' => 'العصافرة', 'city_name_en' => 'Asafra'],
                ['governorate_id' => 3,  'city_name_ar' => 'العجمي', 'city_name_en' => 'Agamy'],
                ['governorate_id' => 3,  'city_name_ar' => 'بكوس', 'city_name_en' => 'Bakos'],
                ['governorate_id' => 3,  'city_name_ar' => 'بولكلي', 'city_name_en' => 'Boulkly'],
                ['governorate_id' => 3,  'city_name_ar' => 'كليوباترا', 'city_name_en' => 'Cleopatra'],
                ['governorate_id' => 3,  'city_name_ar' => 'جليم', 'city_name_en' => 'Glim'],
                ['governorate_id' => 3,  'city_name_ar' => 'المعمورة', 'city_name_en' => 'Al Mamurah'],
                ['governorate_id' => 3,  'city_name_ar' => 'المندرة', 'city_name_en' => 'Al Mandara'],
                ['governorate_id' => 3,  'city_name_ar' => 'محرم بك', 'city_name_en' => 'Moharam Bek'],
                ['governorate_id' => 3,  'city_name_ar' => 'الشاطبي', 'city_name_en' => 'Elshatby'],
                ['governorate_id' => 3,  'city_name_ar' => 'سيدي جابر', 'city_name_en' => 'Sidi Gaber'],
                ['governorate_id' => 3,  'city_name_ar' => 'الساحل الشمالي', 'city_name_en' => 'North Coast/sahel'],
                ['governorate_id' => 3,  'city_name_ar' => 'الحضرة', 'city_name_en' => 'Alhadra'],
                ['governorate_id' => 3,  'city_name_ar' => 'العطارين', 'city_name_en' => 'Alattarin'],
                ['governorate_id' => 3,  'city_name_ar' => 'سيدي كرير', 'city_name_en' => 'Sidi Kerir'],
                ['governorate_id' => 3,  'city_name_ar' => 'الجمرك', 'city_name_en' => 'Elgomrok'],
                ['governorate_id' => 3,  'city_name_ar' => 'المكس', 'city_name_en' => 'Al Max'],
                ['governorate_id' => 3,  'city_name_ar' => 'مارينا', 'city_name_en' => 'Marina'],
                /* End Alexandria ID:3 */ 'city_name_ar' =>

                /* Start Dakahlia ID:4 */
                ['governorate_id' => 4,  'city_name_ar' => 'المنصورة', 'city_name_en' => 'Mansoura'],
                ['governorate_id' => 4,  'city_name_ar' => 'طلخا', 'city_name_en' => 'Talkha'],
                ['governorate_id' => 4,  'city_name_ar' => 'ميت غمر', 'city_name_en' => 'Mitt Ghamr'],
                ['governorate_id' => 4,  'city_name_ar' => 'دكرنس', 'city_name_en' => 'Dekernes'],
                ['governorate_id' => 4,  'city_name_ar' => 'أجا', 'city_name_en' => 'Aga'],
                ['governorate_id' => 4,  'city_name_ar' => 'منية النصر', 'city_name_en' => 'Menia El Nasr'],
                ['governorate_id' => 4,  'city_name_ar' => 'السنبلاوين', 'city_name_en' => 'Sinbillawin'],
                ['governorate_id' => 4,  'city_name_ar' => 'الكردي', 'city_name_en' => 'El Kurdi'],
                ['governorate_id' => 4,  'city_name_ar' => 'بني عبيد', 'city_name_en' => 'Bani Ubaid'],
                ['governorate_id' => 4,  'city_name_ar' => 'المنزلة', 'city_name_en' => 'Al Manzala'],
                ['governorate_id' => 4,  'city_name_ar' => 'تمي الأمديد', 'city_name_en' => 'tami al\'amdid'],
                ['governorate_id' => 4,  'city_name_ar' => 'الجمالية', 'city_name_en' => 'aljamalia'],
                ['governorate_id' => 4,  'city_name_ar' => 'شربين', 'city_name_en' => 'Sherbin'],
                ['governorate_id' => 4,  'city_name_ar' => 'المطرية', 'city_name_en' => 'Mataria'],
                ['governorate_id' => 4,  'city_name_ar' => 'بلقاس', 'city_name_en' => 'Belqas'],
                ['governorate_id' => 4,  'city_name_ar' => 'ميت سلسيل', 'city_name_en' => 'Meet Salsil'],
                ['governorate_id' => 4,  'city_name_ar' => 'جمصة', 'city_name_en' => 'Gamasa'],
                ['governorate_id' => 4,  'city_name_ar' => 'محلة دمنة', 'city_name_en' => 'Mahalat Damana'],
                ['governorate_id' => 4,  'city_name_ar' => 'نبروه', 'city_name_en' => 'Nabroh'],
                /* End Dakahlia ID:4 */

                /* Start Red Sea ID:5 */
                ['governorate_id' => 5,  'city_name_ar' => 'الغردقة', 'city_name_en' => 'Hurghada'],
                ['governorate_id' => 5,  'city_name_ar' => 'رأس غارب', 'city_name_en' => 'Ras Ghareb'],
                ['governorate_id' => 5,  'city_name_ar' => 'سفاجا', 'city_name_en' => 'Safaga'],
                ['governorate_id' => 5,  'city_name_ar' => 'القصير', 'city_name_en' => 'El Qusiar'],
                ['governorate_id' => 5,  'city_name_ar' => 'مرسى علم', 'city_name_en' => 'Marsa Alam'],
                ['governorate_id' => 5,  'city_name_ar' => 'الشلاتين', 'city_name_en' => 'Shalatin'],
                ['governorate_id' => 5,  'city_name_ar' => 'حلايب', 'city_name_en' => 'Halaib'],
                ['governorate_id' => 5,  'city_name_ar' => 'الدهار', 'city_name_en' => 'Aldahar'],
                /* End Red Sea ID:5 */

                /* Start Beheira ID:6 */
                ['governorate_id' => 6,  'city_name_ar' => 'دمنهور', 'city_name_en' => 'Damanhour'],
                ['governorate_id' => 6,  'city_name_ar' => 'كفر الدوار', 'city_name_en' => 'Kafr El Dawar'],
                ['governorate_id' => 6,  'city_name_ar' => 'رشيد', 'city_name_en' => 'Rashid'],
                ['governorate_id' => 6,  'city_name_ar' => 'إدكو', 'city_name_en' => 'Edco'],
                ['governorate_id' => 6,  'city_name_ar' => 'أبو المطامير', 'city_name_en' => 'Abu al-Matamir'],
                ['governorate_id' => 6,  'city_name_ar' => 'أبو حمص', 'city_name_en' => 'Abu Homs'],
                ['governorate_id' => 6,  'city_name_ar' => 'الدلنجات', 'city_name_en' => 'Delengat'],
                ['governorate_id' => 6,  'city_name_ar' => 'المحمودية', 'city_name_en' => 'Mahmoudiyah'],
                ['governorate_id' => 6,  'city_name_ar' => 'الرحمانية', 'city_name_en' => 'Rahmaniyah'],
                ['governorate_id' => 6,  'city_name_ar' => 'إيتاي البارود', 'city_name_en' => 'Itai Baroud'],
                ['governorate_id' => 6,  'city_name_ar' => 'حوش عيسى', 'city_name_en' => 'Housh Eissa'],
                ['governorate_id' => 6,  'city_name_ar' => 'شبراخيت', 'city_name_en' => 'Shubrakhit'],
                ['governorate_id' => 6,  'city_name_ar' => 'كوم حمادة', 'city_name_en' => 'Kom Hamada'],
                ['governorate_id' => 6,  'city_name_ar' => 'بدر', 'city_name_en' => 'Badr'],
                ['governorate_id' => 6,  'city_name_ar' => 'وادي النطرون', 'city_name_en' => 'Wadi Natrun'],
                ['governorate_id' => 6,  'city_name_ar' => 'النوبارية الجديدة', 'city_name_en' => 'New Nubaria'],
                ['governorate_id' => 6,  'city_name_ar' => 'النوبارية', 'city_name_en' => 'Alnoubareya'],
                /* End Beheira ID:6 */

                /* Start Fayoum ID:7 */
                ['governorate_id' => 7,  'city_name_ar' => 'الفيوم', 'city_name_en' => 'Fayoum'],
                ['governorate_id' => 7,  'city_name_ar' => 'الفيوم الجديدة', 'city_name_en' => 'Fayoum El Gedida'],
                ['governorate_id' => 7,  'city_name_ar' => 'طامية', 'city_name_en' => 'Tamiya'],
                ['governorate_id' => 7,  'city_name_ar' => 'سنورس', 'city_name_en' => 'Snores'],
                ['governorate_id' => 7,  'city_name_ar' => 'إطسا', 'city_name_en' => 'Etsa'],
                ['governorate_id' => 7,  'city_name_ar' => 'إبشواي', 'city_name_en' => 'Epschway'],
                ['governorate_id' => 7,  'city_name_ar' => 'يوسف الصديق', 'city_name_en' => 'Yusuf El Sediaq'],
                ['governorate_id' => 7,  'city_name_ar' => 'الحادقة', 'city_name_en' => 'Hadqa'],
                ['governorate_id' => 7,  'city_name_ar' => 'اطسا', 'city_name_en' => 'Atsa'],
                ['governorate_id' => 7,  'city_name_ar' => 'الجامعة', 'city_name_en' => 'Algamaa'],
                ['governorate_id' => 7,  'city_name_ar' => 'السيالة', 'city_name_en' => 'Sayala'],
                /* End Fayoum ID:7 */

                /* Start Gharbia ID:8 */
                ['governorate_id' => 8,  'city_name_ar' => 'طنطا', 'city_name_en' => 'Tanta'],
                ['governorate_id' => 8,  'city_name_ar' => 'المحلة الكبرى', 'city_name_en' => 'Al Mahalla Al Kobra'],
                ['governorate_id' => 8,  'city_name_ar' => 'كفر الزيات', 'city_name_en' => 'Kafr El Zayat'],
                ['governorate_id' => 8,  'city_name_ar' => 'زفتى', 'city_name_en' => 'Zefta'],
                ['governorate_id' => 8,  'city_name_ar' => 'السنطة', 'city_name_en' => 'El Santa'],
                ['governorate_id' => 8,  'city_name_ar' => 'قطور', 'city_name_en' => 'Qutour'],
                ['governorate_id' => 8,  'city_name_ar' => 'بسيون', 'city_name_en' => 'Basion'],
                ['governorate_id' => 8,  'city_name_ar' => 'سمنود', 'city_name_en' => 'Samannoud'],
                /* End Gharbia ID:8 */

                /* Start Ismailia ID:9 */
                ['governorate_id' => 9,  'city_name_ar' => 'الإسماعيلية', 'city_name_en' => 'Ismailia'],
                ['governorate_id' => 9,  'city_name_ar' => 'فايد', 'city_name_en' => 'Fayed'],
                ['governorate_id' => 9,  'city_name_ar' => 'القنطرة شرق', 'city_name_en' => 'Qantara Sharq'],
                ['governorate_id' => 9,  'city_name_ar' => 'القنطرة غرب', 'city_name_en' => 'Qantara Gharb'],
                ['governorate_id' => 9,  'city_name_ar' => 'التل الكبير', 'city_name_en' => 'El Tal El Kabier'],
                ['governorate_id' => 9,  'city_name_ar' => 'أبو صوير', 'city_name_en' => 'Abu Sawir'],
                ['governorate_id' => 9,  'city_name_ar' => 'القصاصين الجديدة', 'city_name_en' => 'Kasasien El Gedida'],
                ['governorate_id' => 9,  'city_name_ar' => 'نفيشة', 'city_name_en' => 'Nefesha'],
                ['governorate_id' => 9,  'city_name_ar' => 'الشيخ زايد', 'city_name_en' => 'Sheikh Zayed'],
                /* End Ismailia ID:9 */

                /* Start Monufya ID:10 */
                ['governorate_id' => 10, 'city_name_ar' => 'شبين الكوم', 'city_name_en' => 'Shbeen El Koom'],
                ['governorate_id' => 10, 'city_name_ar' => 'مدينة السادات', 'city_name_en' => 'Sadat City'],
                ['governorate_id' => 10, 'city_name_ar' => 'منوف', 'city_name_en' => 'Menouf'],
                ['governorate_id' => 10, 'city_name_ar' => 'سرس الليان', 'city_name_en' => 'Sars El-Layan'],
                ['governorate_id' => 10, 'city_name_ar' => 'أشمون', 'city_name_en' => 'Ashmon'],
                ['governorate_id' => 10, 'city_name_ar' => 'الباجور', 'city_name_en' => 'Al Bagor'],
                ['governorate_id' => 10, 'city_name_ar' => 'قويسنا', 'city_name_en' => 'Quesna'],
                ['governorate_id' => 10, 'city_name_ar' => 'بركة السبع', 'city_name_en' => 'Berkat El Saba'],
                ['governorate_id' => 10, 'city_name_ar' => 'تلا', 'city_name_en' => 'Tala'],
                ['governorate_id' => 10, 'city_name_ar' => 'الشهداء', 'city_name_en' => 'Al Shohada'],
                /* Start Monufya ID:10 */

                /* Start Minya ID:11 */
                ['governorate_id' => 11, 'city_name_ar' => 'المنيا', 'city_name_en' => 'Minya'],
                ['governorate_id' => 11, 'city_name_ar' => 'المنيا الجديدة', 'city_name_en' => 'Minya El Gedida'],
                ['governorate_id' => 11, 'city_name_ar' => 'العدوة', 'city_name_en' => 'El Adwa'],
                ['governorate_id' => 11, 'city_name_ar' => 'مغاغة', 'city_name_en' => 'Magagha'],
                ['governorate_id' => 11, 'city_name_ar' => 'بني مزار', 'city_name_en' => 'Bani Mazar'],
                ['governorate_id' => 11, 'city_name_ar' => 'مطاي', 'city_name_en' => 'Mattay'],
                ['governorate_id' => 11, 'city_name_ar' => 'سمالوط', 'city_name_en' => 'Samalut'],
                ['governorate_id' => 11, 'city_name_ar' => 'المدينة الفكرية', 'city_name_en' => 'Madinat El Fekria'],
                ['governorate_id' => 11, 'city_name_ar' => 'ملوي', 'city_name_en' => 'Meloy'],
                ['governorate_id' => 11, 'city_name_ar' => 'دير مواس', 'city_name_en' => 'Deir Mawas'],
                ['governorate_id' => 11, 'city_name_ar' => 'ابو قرقاص', 'city_name_en' => 'Abu Qurqas'],
                ['governorate_id' => 11, 'city_name_ar' => 'ارض سلطان', 'city_name_en' => 'Ard Sultan'],
                /* End Minya ID:11 */

                /* Start Qalubia ID:12 */
                ['governorate_id' => 12, 'city_name_ar' => 'بنها', 'city_name_en' => 'Banha'],
                ['governorate_id' => 12, 'city_name_ar' => 'قليوب', 'city_name_en' => 'Qalyub'],
                ['governorate_id' => 12, 'city_name_ar' => 'شبرا الخيمة', 'city_name_en' => 'Shubra Al Khaimah'],
                ['governorate_id' => 12, 'city_name_ar' => 'القناطر الخيرية', 'city_name_en' => 'Al Qanater Charity'],
                ['governorate_id' => 12, 'city_name_ar' => 'الخانكة', 'city_name_en' => 'Khanka'],
                ['governorate_id' => 12, 'city_name_ar' => 'كفر شكر', 'city_name_en' => 'Kafr Shukr'],
                ['governorate_id' => 12, 'city_name_ar' => 'طوخ', 'city_name_en' => 'Tukh'],
                ['governorate_id' => 12, 'city_name_ar' => 'قها', 'city_name_en' => 'Qaha'],
                ['governorate_id' => 12, 'city_name_ar' => 'العبور', 'city_name_en' => 'Obour'],
                ['governorate_id' => 12, 'city_name_ar' => 'الخصوص', 'city_name_en' => 'Khosous'],
                ['governorate_id' => 12, 'city_name_ar' => 'شبين القناطر', 'city_name_en' => 'Shibin Al Qanater'],
                ['governorate_id' => 12, 'city_name_ar' => 'مسطرد', 'city_name_en' => 'Mostorod'],
                /* End Qalubia ID:12 */

                /* Start New Valley ID:13  */
                ['governorate_id' => 13, 'city_name_ar' => 'الخارجة', 'city_name_en' => 'El Kharga'],
                ['governorate_id' => 13, 'city_name_ar' => 'باريس', 'city_name_en' => 'Paris'],
                ['governorate_id' => 13, 'city_name_ar' => 'موط', 'city_name_en' => 'Mout'],
                ['governorate_id' => 13, 'city_name_ar' => 'الفرافرة', 'city_name_en' => 'Farafra'],
                ['governorate_id' => 13, 'city_name_ar' => 'بلاط', 'city_name_en' => 'Balat'],
                ['governorate_id' => 13, 'city_name_ar' => 'الداخلة', 'city_name_en' => 'Dakhla'],
                /* End New Valley ID:13 * /
 
/* Start South Sinai ID:1 4 */
                ['governorate_id' => 14, 'city_name_ar' => 'السويس', 'city_name_en' => 'Suez'],
                ['governorate_id' => 14, 'city_name_ar' => 'الجناين', 'city_name_en' => 'Alganayen'],
                ['governorate_id' => 14, 'city_name_ar' => 'عتاقة', 'city_name_en' => 'Ataqah'],
                ['governorate_id' => 14, 'city_name_ar' => 'العين السخنة', 'city_name_en' => 'Ain Sokhna'],
                ['governorate_id' => 14, 'city_name_ar' => 'فيصل', 'city_name_en' => 'Faysal'],
                /* End South Sinai ID:14  */

                /* Start Aswan ID:15 */
                ['governorate_id' => 15, 'city_name_ar' => 'أسوان', 'city_name_en' => 'Aswan'],
                ['governorate_id' => 15, 'city_name_ar' => 'أسوان الجديدة', 'city_name_en' => 'Aswan El Gedida'],
                ['governorate_id' => 15, 'city_name_ar' => 'دراو', 'city_name_en' => 'Drau'],
                ['governorate_id' => 15, 'city_name_ar' => 'كوم أمبو', 'city_name_en' => 'Kom Ombo'],
                ['governorate_id' => 15, 'city_name_ar' => 'نصر النوبة', 'city_name_en' => 'Nasr Al Nuba'],
                ['governorate_id' => 15, 'city_name_ar' => 'كلابشة', 'city_name_en' => 'Kalabsha'],
                ['governorate_id' => 15, 'city_name_ar' => 'إدفو', 'city_name_en' => 'Edfu'],
                ['governorate_id' => 15, 'city_name_ar' => 'الرديسية', 'city_name_en' => 'Al-Radisiyah'],
                ['governorate_id' => 15, 'city_name_ar' => 'البصيلية', 'city_name_en' => 'Al Basilia'],
                ['governorate_id' => 15, 'city_name_ar' => 'السباعية', 'city_name_en' => 'Al Sibaeia'],
                ['governorate_id' => 15, 'city_name_ar' => 'ابوسمبل السياحية', 'city_name_en' => 'Abo Simbl Al Siyahia'],
                ['governorate_id' => 15, 'city_name_ar' => 'مرسى علم', 'city_name_en' => 'Marsa Alam'],
                /* End Aswan ID:15 */

                /* Start Assiut ID:16 */
                ['governorate_id' => 16, 'city_name_ar' => 'أسيوط', 'city_name_en' => 'Assiut'],
                ['governorate_id' => 16, 'city_name_ar' => 'أسيوط الجديدة', 'city_name_en' => 'Assiut El Gedida'],
                ['governorate_id' => 16, 'city_name_ar' => 'ديروط', 'city_name_en' => 'Dayrout'],
                ['governorate_id' => 16, 'city_name_ar' => 'منفلوط', 'city_name_en' => 'Manfalut'],
                ['governorate_id' => 16, 'city_name_ar' => 'القوصية', 'city_name_en' => 'Qusiya'],
                ['governorate_id' => 16, 'city_name_ar' => 'أبنوب', 'city_name_en' => 'Abnoub'],
                ['governorate_id' => 16, 'city_name_ar' => 'أبو تيج', 'city_name_en' => 'Abu Tig'],
                ['governorate_id' => 16, 'city_name_ar' => 'الغنايم', 'city_name_en' => 'El Ghanaim'],
                ['governorate_id' => 16, 'city_name_ar' => 'ساحل سليم', 'city_name_en' => 'Sahel Selim'],
                ['governorate_id' => 16, 'city_name_ar' => 'البداري', 'city_name_en' => 'El Badari'],
                ['governorate_id' => 16, 'city_name_ar' => 'صدفا', 'city_name_en' => 'Sidfa'],
                /* End Assiut ID:16 */

                /* Start Bani Sweif ID:17  */
                ['governorate_id' => 17, 'city_name_ar' => 'بني سويف', 'city_name_en' => 'Bani Sweif'],
                ['governorate_id' => 17, 'city_name_ar' => 'بني سويف الجديدة', 'city_name_en' => 'Beni Suef El Gedida'],
                ['governorate_id' => 17, 'city_name_ar' => 'الواسطى', 'city_name_en' => 'Al Wasta'],
                ['governorate_id' => 17, 'city_name_ar' => 'ناصر', 'city_name_en' => 'Naser'],
                ['governorate_id' => 17, 'city_name_ar' => 'إهناسيا', 'city_name_en' => 'Ehnasia'],
                ['governorate_id' => 17, 'city_name_ar' => 'ببا', 'city_name_en' => 'beba'],
                ['governorate_id' => 17, 'city_name_ar' => 'الفشن', 'city_name_en' => 'Fashn'],
                ['governorate_id' => 17, 'city_name_ar' => 'سمسطا', 'city_name_en' => 'Somasta'],
                ['governorate_id' => 17, 'city_name_ar' => 'الاباصيرى', 'city_name_en' => 'Alabbaseri'],
                ['governorate_id' => 17, 'city_name_ar' => 'مقبل', 'city_name_en' => 'Mokbel'],
                /* End Bani Sweif ID:17 * /
 
/* Start PorSaid ID:18 */
                ['governorate_id' => 18, 'city_name_ar' => 'بورسعيد', 'city_name_en' => 'PorSaid'],
                ['governorate_id' => 18, 'city_name_ar' => 'بورفؤاد', 'city_name_en' => 'Port Fouad'],
                ['governorate_id' => 18, 'city_name_ar' => 'العرب', 'city_name_en' => 'Alarab'],
                ['governorate_id' => 18, 'city_name_ar' => 'حى الزهور', 'city_name_en' => 'Zohour'],
                ['governorate_id' => 18, 'city_name_ar' => 'حى الشرق', 'city_name_en' => 'Alsharq'],
                ['governorate_id' => 18, 'city_name_ar' => 'حى الضواحى', 'city_name_en' => 'Aldawahi'],
                ['governorate_id' => 18, 'city_name_ar' => 'حى المناخ', 'city_name_en' => 'Almanakh'],
                ['governorate_id' => 18, 'city_name_ar' => 'حى مبارك', 'city_name_en' => 'Mubarak'],
                /* End PorSaid ID:18 */

                /* Start Damietta ID:19 */
                ['governorate_id' => 19, 'city_name_ar' => 'دمياط', 'city_name_en' => 'Damietta'],
                ['governorate_id' => 19, 'city_name_ar' => 'دمياط الجديدة', 'city_name_en' => 'New Damietta'],
                ['governorate_id' => 19, 'city_name_ar' => 'رأس البر', 'city_name_en' => 'Ras El Bar'],
                ['governorate_id' => 19, 'city_name_ar' => 'فارسكور', 'city_name_en' => 'Faraskour'],
                ['governorate_id' => 19, 'city_name_ar' => 'الزرقا', 'city_name_en' => 'Zarqa'],
                ['governorate_id' => 19, 'city_name_ar' => 'السرو', 'city_name_en' => 'alsaru'],
                ['governorate_id' => 19, 'city_name_ar' => 'الروضة', 'city_name_en' => 'alruwda'],
                ['governorate_id' => 19, 'city_name_ar' => 'كفر البطيخ', 'city_name_en' => 'Kafr El-Batikh'],
                ['governorate_id' => 19, 'city_name_ar' => 'عزبة البرج', 'city_name_en' => 'Azbet Al Burg'],
                ['governorate_id' => 19, 'city_name_ar' => 'ميت أبو غالب', 'city_name_en' => 'Meet Abou Ghalib'],
                ['governorate_id' => 19, 'city_name_ar' => 'كفر سعد', 'city_name_en' => 'Kafr Saad'],
                /* End Damietta ID:19 */

                /* Start Sharqia ID:20 */
                ['governorate_id' => 20, 'city_name_ar' => 'الزقازيق', 'city_name_en' => 'Zagazig'],
                ['governorate_id' => 20, 'city_name_ar' => 'العاشر من رمضان', 'city_name_en' => 'Al Ashr Men Ramadan'],
                ['governorate_id' => 20, 'city_name_ar' => 'منيا القمح', 'city_name_en' => 'Minya Al Qamh'],
                ['governorate_id' => 20, 'city_name_ar' => 'بلبيس', 'city_name_en' => 'Belbeis'],
                ['governorate_id' => 20, 'city_name_ar' => 'مشتول السوق', 'city_name_en' => 'Mashtoul El Souq'],
                ['governorate_id' => 20, 'city_name_ar' => 'القنايات', 'city_name_en' => 'Qenaiat'],
                ['governorate_id' => 20, 'city_name_ar' => 'أبو حماد', 'city_name_en' => 'Abu Hammad'],
                ['governorate_id' => 20, 'city_name_ar' => 'القرين', 'city_name_en' => 'El Qurain'],
                ['governorate_id' => 20, 'city_name_ar' => 'ههيا', 'city_name_en' => 'Hehia'],
                ['governorate_id' => 20, 'city_name_ar' => 'أبو كبير', 'city_name_en' => 'Abu Kabir'],
                ['governorate_id' => 20, 'city_name_ar' => 'فاقوس', 'city_name_en' => 'Faccus'],
                ['governorate_id' => 20, 'city_name_ar' => 'الصالحية الجديدة', 'city_name_en' => 'El Salihia El Gedida'],
                ['governorate_id' => 20, 'city_name_ar' => 'الإبراهيمية', 'city_name_en' => 'Al Ibrahimiyah'],
                ['governorate_id' => 20, 'city_name_ar' => 'ديرب نجم', 'city_name_en' => 'Deirb Negm'],
                ['governorate_id' => 20, 'city_name_ar' => 'كفر صقر', 'city_name_en' => 'Kafr Saqr'],
                ['governorate_id' => 20, 'city_name_ar' => 'أولاد صقر', 'city_name_en' => 'Awlad Saqr'],
                ['governorate_id' => 20, 'city_name_ar' => 'الحسينية', 'city_name_en' => 'Husseiniya'],
                ['governorate_id' => 20, 'city_name_ar' => 'صان الحجر القبلية', 'city_name_en' => 'san alhajar alqablia'],
                ['governorate_id' => 20, 'city_name_ar' => 'منشأة أبو عمر', 'city_name_en' => 'Manshayat Abu Omar'],
                /* End Sharqia ID:20 */

                /* Start South Sinai ID:2 1 */
                ['governorate_id' => 21, 'city_name_ar' => 'الطور', 'city_name_en' => 'Al Toor'],
                ['governorate_id' => 21, 'city_name_ar' => 'شرم الشيخ', 'city_name_en' => 'Sharm El-Shaikh'],
                ['governorate_id' => 21, 'city_name_ar' => 'دهب', 'city_name_en' => 'Dahab'],
                ['governorate_id' => 21, 'city_name_ar' => 'نويبع', 'city_name_en' => 'Nuweiba'],
                ['governorate_id' => 21, 'city_name_ar' => 'طابا', 'city_name_en' => 'Taba'],
                ['governorate_id' => 21, 'city_name_ar' => 'سانت كاترين', 'city_name_en' => 'Saint Catherine'],
                ['governorate_id' => 21, 'city_name_ar' => 'أبو رديس', 'city_name_en' => 'Abu Redis'],
                ['governorate_id' => 21, 'city_name_ar' => 'أبو زنيمة', 'city_name_en' => 'Abu Zenaima'],
                ['governorate_id' => 21, 'city_name_ar' => 'رأس سدر', 'city_name_en' => 'Ras Sidr'],
                /* End South Sinai ID:21  */

                /* Start Kafr El Sheikh I D:22 */
                ['governorate_id' => 22, 'city_name_ar' => 'كفر الشيخ', 'city_name_en' => 'Kafr El Sheikh'],
                ['governorate_id' => 22, 'city_name_ar' => 'وسط البلد كفر الشيخ', 'city_name_en' => 'Kafr El Sheikh Downtown'],
                ['governorate_id' => 22, 'city_name_ar' => 'دسوق', 'city_name_en' => 'Desouq'],
                ['governorate_id' => 22, 'city_name_ar' => 'فوه', 'city_name_en' => 'Fooh'],
                ['governorate_id' => 22, 'city_name_ar' => 'مطوبس', 'city_name_en' => 'Metobas'],
                ['governorate_id' => 22, 'city_name_ar' => 'برج البرلس', 'city_name_en' => 'Burg Al Burullus'],
                ['governorate_id' => 22, 'city_name_ar' => 'بلطيم', 'city_name_en' => 'Baltim'],
                ['governorate_id' => 22, 'city_name_ar' => 'مصيف بلطيم', 'city_name_en' => 'Masief Baltim'],
                ['governorate_id' => 22, 'city_name_ar' => 'الحامول', 'city_name_en' => 'Hamol'],
                ['governorate_id' => 22, 'city_name_ar' => 'بيلا', 'city_name_en' => 'Bella'],
                ['governorate_id' => 22, 'city_name_ar' => 'الرياض', 'city_name_en' => 'Riyadh'],
                ['governorate_id' => 22, 'city_name_ar' => 'سيدي سالم', 'city_name_en' => 'Sidi Salm'],
                ['governorate_id' => 22, 'city_name_ar' => 'قلين', 'city_name_en' => 'Qellen'],
                ['governorate_id' => 22, 'city_name_ar' => 'سيدي غازي', 'city_name_en' => 'Sidi Ghazi'],
                /* End Kafr El Sheikh ID: 22 */

                /* Start Matrouh ID:23 */
                ['governorate_id' => 23, 'city_name_ar' => 'مرسى مطروح', 'city_name_en' => 'Marsa Matrouh'],
                ['governorate_id' => 23, 'city_name_ar' => 'الحمام', 'city_name_en' => 'El Hamam'],
                ['governorate_id' => 23, 'city_name_ar' => 'العلمين', 'city_name_en' => 'Alamein'],
                ['governorate_id' => 23, 'city_name_ar' => 'الضبعة', 'city_name_en' => 'Dabaa'],
                ['governorate_id' => 23, 'city_name_ar' => 'النجيلة', 'city_name_en' => 'Al-Nagila'],
                ['governorate_id' => 23, 'city_name_ar' => 'سيدي براني', 'city_name_en' => 'Sidi Brani'],
                ['governorate_id' => 23, 'city_name_ar' => 'السلوم', 'city_name_en' => 'Salloum'],
                ['governorate_id' => 23, 'city_name_ar' => 'سيوة', 'city_name_en' => 'Siwa'],
                ['governorate_id' => 23, 'city_name_ar' => 'مارينا', 'city_name_en' => 'Marina'],
                ['governorate_id' => 23, 'city_name_ar' => 'الساحل الشمالى', 'city_name_en' => 'North Coast'],
                /* End Matrouh ID:23 */

                /* Start Luxor ID:24 */
                ['governorate_id' => 24, 'city_name_ar' => 'الأقصر', 'city_name_en' => 'Luxor'],
                ['governorate_id' => 24, 'city_name_ar' => 'الأقصر الجديدة', 'city_name_en' => 'New Luxor'],
                ['governorate_id' => 24, 'city_name_ar' => 'إسنا', 'city_name_en' => 'Esna'],
                ['governorate_id' => 24, 'city_name_ar' => 'طيبة الجديدة', 'city_name_en' => 'New Tiba'],
                ['governorate_id' => 24, 'city_name_ar' => 'الزينية', 'city_name_en' => 'Al ziynia'],
                ['governorate_id' => 24, 'city_name_ar' => 'البياضية', 'city_name_en' => 'Al Bayadieh'],
                ['governorate_id' => 24, 'city_name_ar' => 'القرنة', 'city_name_en' => 'Al Qarna'],
                ['governorate_id' => 24, 'city_name_ar' => 'أرمنت', 'city_name_en' => 'Armant'],
                ['governorate_id' => 24, 'city_name_ar' => 'الطود', 'city_name_en' => 'Al Tud'],
                /* End Luxor ID:24 */

                /* Start Qena ID:25 */
                ['governorate_id' => 25, 'city_name_ar' => 'قنا', 'city_name_en' => 'Qena'],
                ['governorate_id' => 25, 'city_name_ar' => 'قنا الجديدة', 'city_name_en' => 'New Qena'],
                ['governorate_id' => 25, 'city_name_ar' => 'ابو طشت', 'city_name_en' => 'Abu Tesht'],
                ['governorate_id' => 25, 'city_name_ar' => 'نجع حمادي', 'city_name_en' => 'Nag Hammadi'],
                ['governorate_id' => 25, 'city_name_ar' => 'دشنا', 'city_name_en' => 'Deshna'],
                ['governorate_id' => 25, 'city_name_ar' => 'الوقف', 'city_name_en' => 'Alwaqf'],
                ['governorate_id' => 25, 'city_name_ar' => 'قفط', 'city_name_en' => 'Qaft'],
                ['governorate_id' => 25, 'city_name_ar' => 'نقادة', 'city_name_en' => 'Naqada'],
                ['governorate_id' => 25, 'city_name_ar' => 'فرشوط', 'city_name_en' => 'Farshout'],
                ['governorate_id' => 25, 'city_name_ar' => 'قوص', 'city_name_en' => 'Quos'],
                /* End Qena ID:25 */

                /* Start North Sinai ID:2 6 */
                ['governorate_id' => 26, 'city_name_ar' => 'العريش', 'city_name_en' => 'Arish'],
                ['governorate_id' => 26, 'city_name_ar' => 'الشيخ زويد', 'city_name_en' => 'Sheikh Zowaid'],
                ['governorate_id' => 26, 'city_name_ar' => 'نخل', 'city_name_en' => 'Nakhl'],
                ['governorate_id' => 26, 'city_name_ar' => 'رفح', 'city_name_en' => 'Rafah'],
                ['governorate_id' => 26, 'city_name_ar' => 'بئر العبد', 'city_name_en' => 'Bir al-Abed'],
                ['governorate_id' => 26, 'city_name_ar' => 'الحسنة', 'city_name_en' => 'Al Hasana'],
                /* End North Sinai ID:26  */

                /* Start Sohag ID:27 */
                ['governorate_id' => 27, 'city_name_ar' => 'سوهاج', 'city_name_en' => 'Sohag'],
                ['governorate_id' => 27, 'city_name_ar' => 'سوهاج الجديدة', 'city_name_en' => 'Sohag El Gedida'],
                ['governorate_id' => 27, 'city_name_ar' => 'أخميم', 'city_name_en' => 'Akhmeem'],
                ['governorate_id' => 27, 'city_name_ar' => 'أخميم الجديدة', 'city_name_en' => 'Akhmim El Gedida'],
                ['governorate_id' => 27, 'city_name_ar' => 'البلينا', 'city_name_en' => 'Albalina'],
                ['governorate_id' => 27, 'city_name_ar' => 'المراغة', 'city_name_en' => 'El Maragha'],
                ['governorate_id' => 27, 'city_name_ar' => 'المنشأة', 'city_name_en' => "almunsha\'a"],
                ['governorate_id' => 27, 'city_name_ar' => 'دار السلام', 'city_name_en' => 'Dar AISalaam'],
                ['governorate_id' => 27, 'city_name_ar' => 'جرجا', 'city_name_en' => 'Gerga'],
                ['governorate_id' => 27, 'city_name_ar' => 'جهينة الغربية', 'city_name_en' => 'Jahina Al Gharbia'],
                ['governorate_id' => 27, 'city_name_ar' => 'ساقلته', 'city_name_en' => 'Saqilatuh'],
                ['governorate_id' => 27, 'city_name_ar' => 'طما', 'city_name_en' => 'Tama'],
                ['governorate_id' => 27, 'city_name_ar' => 'طهطا', 'city_name_en' => 'Tahta'],
                ['governorate_id' => 27, 'city_name_ar' => 'الكوثر', 'city_name_en' => 'Alkawthar'],
                /* End Sharqia ID:27 */
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            //
        });
    }
}
