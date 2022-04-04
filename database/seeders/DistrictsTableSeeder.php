<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('districts')->delete();

        $nowDateTime = Carbon::now()->toDateTimeString();

        \DB::table('districts')->insert(array (
            0 =>
                array (
                    'district_id' => 1,
                    'fk_province_id' => 1,
                    'district_name' => 'Taplejung',
                    'district_name_np' => 'ताप्लेजुङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            1 =>
                array (
                    'district_id' => 2,
                    'fk_province_id' => 1,
                    'district_name' => 'Panchthar',
                    'district_name_np' => 'पाँचथर',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            2 =>
                array (
                    'district_id' => 3,
                    'fk_province_id' => 1,
                    'district_name' => 'Iilam',
                    'district_name_np' => 'ईलाम',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            3 =>
                array (
                    'district_id' => 4,
                    'fk_province_id' => 1,
                    'district_name' => 'Jhapa',
                    'district_name_np' => 'झापा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            4 =>
                array (
                    'district_id' => 5,
                    'fk_province_id' => 1,
                    'district_name' => 'Morong',
                    'district_name_np' => 'मोरंग',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            5 =>
                array (
                    'district_id' => 6,
                    'fk_province_id' => 1,
                    'district_name' => 'Sunsari',
                    'district_name_np' => 'सुनसरी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            6 =>
                array (
                    'district_id' => 7,
                    'fk_province_id' => 1,
                    'district_name' => 'Dhankuta',
                    'district_name_np' => 'धनकुटा',
'created_at' => $nowDateTime,
'updated_at' => $nowDateTime,
                ),
            7 =>
                array (
                    'district_id' => 8,
                    'fk_province_id' => 1,
                    'district_name' => 'Therathum',
                    'district_name_np' => 'तेहथुम',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            8 =>
                array (
                    'district_id' => 9,
                    'fk_province_id' => 1,
                    'district_name' => 'Sankhuwasava',
                    'district_name_np' => 'संखुवासभा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            9 =>
                array (
                    'district_id' => 10,
                    'fk_province_id' => 1,
                    'district_name' => 'Bhojpur',
                    'district_name_np' => 'भोजपुर',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            10 =>
                array (
                    'district_id' => 11,
                    'fk_province_id' => 1,
                    'district_name' => 'Solukhambu',
                    'district_name_np' => 'सोलुखुम्बु',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            11 =>
                array (
                    'district_id' => 12,
                    'fk_province_id' => 1,
                    'district_name' => 'Okahdhunga',
                    'district_name_np' => 'ओखलढुंगा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            12 =>
                array (
                    'district_id' => 13,
                    'fk_province_id' => 1,
                    'district_name' => 'khotang',
                    'district_name_np' => 'खोटाङ',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            13 =>
                array (
                    'district_id' => 14,
                    'fk_province_id' => 1,
                    'district_name' => 'Udayapur',
                    'district_name_np' => 'उदयपुर',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            14 =>
                array (
                    'district_id' => 15,
                    'fk_province_id' => 2,
                    'district_name' => 'Saptari',
                    'district_name_np' => 'सप्तरी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            15 =>
                array (
                    'district_id' => 16,
                    'fk_province_id' => 2,
                    'district_name' => 'Siraha',
                    'district_name_np' => 'सिराहा',
                        'created_at' => $nowDateTime,
                        'updated_at' => $nowDateTime,
                ),
            16 =>
                array (
                    'district_id' => 17,
                    'fk_province_id' => 2,
                    'district_name' => 'Dhanusa',
                    'district_name_np' => 'धनुषा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            17 =>
                array (
                    'district_id' => 18,
                    'fk_province_id' => 2,
                    'district_name' => 'Mahotari',
                    'district_name_np' => 'महोत्तरी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            18 =>
                array (
                    'district_id' => 19,
                    'fk_province_id' => 2,
                    'district_name' => 'Sarlahi',
                    'district_name_np' => 'सर्लाही',
'created_at' => $nowDateTime,
'updated_at' => $nowDateTime,
                ),
            19 =>
                array (
                    'district_id' => 20,
                    'fk_province_id' => 3,
                    'district_name' => 'Sindhuli',
                    'district_name_np' => 'सिन्धुली',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            20 =>
                array (
                    'district_id' => 21,
                    'fk_province_id' => 3,
                    'district_name' => 'Ramechap',
                    'district_name_np' => 'रामेछाप',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            21 =>
                array (
                    'district_id' => 22,
                    'fk_province_id' => 3,
                    'district_name' => 'Dolakha',
                    'district_name_np' => 'दोलखा',
            'created_at' => $nowDateTime,
            'updated_at' => $nowDateTime,
                ),
            22 =>
                array (
                    'district_id' => 23,
                    'fk_province_id' => 3,
                    'district_name' => 'Sindhupalchok',
                    'district_name_np' => 'सिन्धुपाल्चोक',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            23 =>
                array (
                    'district_id' => 24,
                    'fk_province_id' => 3,
                    'district_name' => 'Kavarepalanchok',
                    'district_name_np' => 'काभ्रेपलान्चोक',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            24 =>
                array (
                    'district_id' => 25,
                    'fk_province_id' => 3,
                    'district_name' => 'Lalitpur',
                    'district_name_np' => 'ललितपुर',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            25 =>
                array (
                    'district_id' => 26,
                    'fk_province_id' => 3,
                    'district_name' => 'Bhaktapur',
                    'district_name_np' => 'भक्तपुर',
 'created_at' => $nowDateTime,
 'updated_at' => $nowDateTime,
                ),
            26 =>
                array (
                    'district_id' => 27,
                    'fk_province_id' => 3,
                    'district_name' => 'Kathmandu',
                    'district_name_np' => 'काठमाण्डौ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            27 =>
                array (
                    'district_id' => 28,
                    'fk_province_id' => 3,
                    'district_name' => 'Nuwakot',
                    'district_name_np' => 'नुवाकोट',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            28 =>
                array (
                    'district_id' => 29,
                    'fk_province_id' => 3,
                    'district_name' => 'Rasuwa',
                    'district_name_np' => 'रसुवा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            29 =>
                array (
                    'district_id' => 30,
                    'fk_province_id' => 3,
                    'district_name' => 'Dhading',
                    'district_name_np' => 'धादिङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            30 =>
                array (
                    'district_id' => 31,
                    'fk_province_id' => 3,
                    'district_name' => 'Makawanpur',
                    'district_name_np' => 'मकवानपुर',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            31 =>
                array (
                    'district_id' => 32,
                    'fk_province_id' => 2,
                    'district_name' => 'Rautahat',
                    'district_name_np' => 'रौतहट',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            32 =>
                array (
                    'district_id' => 33,
                    'fk_province_id' => 2,
                    'district_name' => 'Bara',
                    'district_name_np' => 'वारा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            33 =>
                array (
                    'district_id' => 34,
                    'fk_province_id' => 2,
                    'district_name' => 'Parsa',
                    'district_name_np' => 'पर्सा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            34 =>
                array (
                    'district_id' => 35,
                    'fk_province_id' => 3,
                    'district_name' => 'Chitwan',
                    'district_name_np' => 'चितवन',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            35 =>
                array (
                    'district_id' => 36,
                    'fk_province_id' => 4,
                    'district_name' => 'Gorkha',
                    'district_name_np' => 'गोरखा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            36 =>
                array (
                    'district_id' => 37,
                    'fk_province_id' => 4,
                    'district_name' => 'Lamjung',
                    'district_name_np' => 'लमजुङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            37 =>
                array (
                    'district_id' => 38,
                    'fk_province_id' => 4,
                    'district_name' => 'Tanahu',
                    'district_name_np' => 'तनहुँ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            38 =>
                array (
                    'district_id' => 39,
                    'fk_province_id' => 4,
                    'district_name' => 'Sangja',
                    'district_name_np' => 'स्याङजा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            39 =>
                array (
                    'district_id' => 40,
                    'fk_province_id' => 4,
                    'district_name' => 'Kaski',
                    'district_name_np' => 'कास्की',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            40 =>
                array (
                    'district_id' => 41,
                    'fk_province_id' => 4,
                    'district_name' => 'Manang',
                    'district_name_np' => 'मनाङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            41 =>
                array (
                    'district_id' => 42,
                    'fk_province_id' => 4,
                    'district_name' => 'Mustang',
                    'district_name_np' => 'मुस्ताङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            42 =>
                array (
                    'district_id' => 43,
                    'fk_province_id' => 4,
                    'district_name' => 'Magdi',
                    'district_name_np' => 'म्याग्दी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            43 =>
                array (
                    'district_id' => 44,
                    'fk_province_id' => 4,
                    'district_name' => 'Parbat',
                    'district_name_np' => 'पर्वत',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            44 =>
                array (
                    'district_id' => 45,
                    'fk_province_id' => 4,
                    'district_name' => 'Baglung',
                    'district_name_np' => 'वाग्लुङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            45 =>
                array (
                    'district_id' => 46,
                    'fk_province_id' => 5,
                    'district_name' => 'Gulmi',
                    'district_name_np' => 'गुल्मी',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            46 =>
                array (
                    'district_id' => 47,
                    'fk_province_id' => 5,
                    'district_name' => 'Palpa',
                    'district_name_np' => 'पाल्पा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            47 =>
                array (
                    'district_id' => 48,
                    'fk_province_id' => 5,
                    'district_name' => 'Rupendehi',
                    'district_name_np' => 'रुपन्देही',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            48 =>
                array (
                    'district_id' => 49,
                    'fk_province_id' => 5,
                    'district_name' => 'Kapilbustu',
                    'district_name_np' => 'कपिलबस्तु',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            49 =>
                array (
                    'district_id' => 50,
                    'fk_province_id' => 5,
                    'district_name' => 'Argakhachi',
                    'district_name_np' => 'अर्घाखाँची',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            50 =>
                array (
                    'district_id' => 51,
                    'fk_province_id' => 5,
                    'district_name' => 'Puthun',
                    'district_name_np' => 'प्यूठान',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            51 =>
                array (
                    'district_id' => 52,
                    'fk_province_id' => 5,
                    'district_name' => 'Rolpa',
                    'district_name_np' => 'रोल्पा',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            52 =>
                array (
                    'district_id' => 53,
                    'fk_province_id' => 6,
                    'district_name' => 'Rukum (West)',
                    'district_name_np' => 'रुकुम (पश्चिम)',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            53 =>
                array (
                    'district_id' => 54,
                    'fk_province_id' => 5,
                    'district_name' => 'Rukum (East)',
                    'district_name_np' => 'रुकुम (पूर्वी)',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            54 =>
                array (
                    'district_id' => 55,
                    'fk_province_id' => 6,
                    'district_name' => 'Salyan',
                    'district_name_np' => 'सल्यान',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            55 =>
                array (
                    'district_id' => 56,
                    'fk_province_id' => 5,
                    'district_name' => 'Dang',
                    'district_name_np' => 'दाङ',
            'created_at' => $nowDateTime,
            'updated_at' => $nowDateTime,
                ),
            56 =>
                array (
                    'district_id' => 57,
                    'fk_province_id' => 5,
                    'district_name' => 'Bake',
                    'district_name_np' => 'बाँके',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            57 =>
                array (
                    'district_id' => 58,
                    'fk_province_id' => 5,
                    'district_name' => 'Bardiya',
                    'district_name_np' => 'बर्दिया',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            58 =>
                array (
                    'district_id' => 59,
                    'fk_province_id' => 6,
                    'district_name' => 'Sukhet',
                    'district_name_np' => 'सुर्खेत',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            59 =>
                array (
                    'district_id' => 60,
                    'fk_province_id' => 6,
                    'district_name' => 'Dailekh',
                    'district_name_np' => 'दैलेख',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            60 =>
                array (
                    'district_id' => 61,
                    'fk_province_id' => 6,
                    'district_name' => 'Jajarkoat',
                    'district_name_np' => 'जाजरकोट',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            61 =>
                array (
                    'district_id' => 62,
                    'fk_province_id' => 6,
                    'district_name' => 'Dolpa',
                    'district_name_np' => 'डोल्पा',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            62 =>
                array (
                    'district_id' => 63,
                    'fk_province_id' => 6,
                    'district_name' => 'Jumla',
                    'district_name_np' => 'जुम्ला',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            63 =>
                array (
                    'district_id' => 64,
                    'fk_province_id' => 6,
                    'district_name' => 'kalikot',
                    'district_name_np' => 'कालिकोट',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            64 =>
                array (
                    'district_id' => 65,
                    'fk_province_id' => 6,
                    'district_name' => 'Mugu',
                    'district_name_np' => 'मुगु',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            65 =>
                array (
                    'district_id' => 66,
                    'fk_province_id' => 6,
                    'district_name' => 'Humla',
                    'district_name_np' => 'हुम्ला',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            66 =>
                array (
                    'district_id' => 67,
                    'fk_province_id' => 7,
                    'district_name' => 'Bajura',
                    'district_name_np' => 'बाजुरा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            67 =>
                array (
                    'district_id' => 68,
                    'fk_province_id' => 7,
                    'district_name' => 'Bajhang',
                    'district_name_np' => 'बझाङ',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            68 =>
                array (
                    'district_id' => 69,
                    'fk_province_id' => 7,
                    'district_name' => 'Acham',
                    'district_name_np' => 'अछाम',
'created_at' => $nowDateTime,
'updated_at' => $nowDateTime,
                ),
            69 =>
                array (
                    'district_id' => 70,
                    'fk_province_id' => 7,
                    'district_name' => 'Doti',
                    'district_name_np' => 'डोटी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            70 =>
                array (
                    'district_id' => 71,
                    'fk_province_id' => 7,
                    'district_name' => 'Kailali',
                    'district_name_np' => 'कैलाली',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            71 =>
                array (
                    'district_id' => 72,
                    'fk_province_id' => 7,
                    'district_name' => 'Kanchanpur',
                    'district_name_np' => 'कञ्चनपुर',
                'created_at' => $nowDateTime,
                'updated_at' => $nowDateTime,
                ),
            72 =>
                array (
                    'district_id' => 73,
                    'fk_province_id' => 7,
                    'district_name' => 'Dadeldhura',
                    'district_name_np' => 'डडेलधुरा',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            73 =>
                array (
                    'district_id' => 74,
                    'fk_province_id' => 7,
                    'district_name' => 'Baitadi',
                    'district_name_np' => 'बैतडी',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            74 =>
                array (
                    'district_id' => 75,
                    'fk_province_id' => 7,
                    'district_name' => 'Darchula',
                    'district_name_np' => 'दार्चुला',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            75 =>
                array (
                    'district_id' => 76,
                    'fk_province_id' => 4,
                    'district_name' => 'Nawalparasi (East)',
                    'district_name_np' => 'नवलपरासी (पूर्व)',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            76 =>
                array (
                    'district_id' => 77,
                    'fk_province_id' => 5,
                    'district_name' => 'Nawalparasi (West)',
                    'district_name_np' => 'नवलपरासी (पश्चिम)',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
        ));


    }
}
