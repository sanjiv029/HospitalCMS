<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = "INSERT INTO `districts` VALUES

        (1,1,'1','ताप्लेजुङ','Taplejung',NULL,NULL,NULL),
        (2,1,'2','पाचथर','Panchthar',NULL ,NULL,NULL),
        (3,1,'3','ईलाम','Ilam',NULL,NULL,NULL),
        (4,1,'4','झापा','Jhapa',NULL,NULL,NULL),
        (5,1,'5','मोरङ','Morang',NULL,NULL,NULL),
        (6,1,'6','सुनसरि','Sunsari',NULL,NULL,NULL),
        (7,1,'7','धनकुटा','Dhankuta',NULL,NULL,NULL),
        (8,1,'8','तेह्थुम','Terhathum',NULL,NULL,NULL),
        (9,1,'9','संखुवासभा','Sankhuwasabha',NULL,NULL,NULL),
        (10,1,'10','भोजपुर','Bhojpur',NULL,NULL,NULL),
        (11,1,'11','सोलुखुम्बु','Solukhumbu',NULL,NULL,NULL),
        (12,1,'12','ओखलढुङ्गा','Okhaldhunga',NULL,NULL,NULL),
        (13,1,'13','खोटाङ','Khotang',NULL,NULL,NULL),
        (14,1,'14','उदयपुर','Udayapur',NULL,NULL,NULL),
        (15,2,'15','सप्तरी','Saptari',NULL,NULL,NULL),
        (16,2,'16','सिरहा','Siraha',NULL,NULL,NULL),
        (17,2,'17','धनुषा','Dhanusa',NULL,NULL,NULL),
        (18,2,'18','महोत्तरी','Mahottari',NULL,NULL,NULL),
        (19,2,'19','सर्लाहि','Sarlahi',NULL,NULL,NULL),
        (20,2,'20','रौतहट','Rautahat',NULL,NULL,NULL),
        (21,2,'21','बारा','Bara',NULL,NULL,NULL),
        (22,2,'22','पर्सा','Parsa',NULL,NULL,NULL),
        (23,3,'23','सिन्धुली','Sindhuli',NULL,NULL,NULL),
        (24,3,'24','रामेछाप','Ramechhap',NULL,NULL,NULL),
        (25,3,'25','दोलखा','Dolakha',NULL,NULL,NULL),
        (26,3,'26','सिन्धुपाल्चोक','Sindhupalchok',NULL,NULL,NULL),
        (27,3,'27','काभ्रेपलाञ्चोक','Kavrepalanchok',NULL,NULL,NULL),
        (28,3,'28','ललितपुर','Lalitpur',NULL,NULL,NULL),
        (29,3,'29','भक्तपुर','Bhaktapur',NULL,NULL,NULL),
        (30,3,'30','काठमाण्डौ','Kathmandu',NULL,NULL,NULL),
        (31,3,'31','नुवाकोट','Nuwakot',NULL,NULL,NULL),
        (32,3,'32','रसुवा','Rasuwa',NULL,NULL,NULL),
        (33,3,'33','धादिङ','Dhading',NULL,NULL,NULL),
        (34,3,'34','मकवानपुर','Makwanpur',NULL,NULL,NULL),
        (35,3,'35','चितवन','Chitawan',NULL,NULL,NULL),
        (36,4,'36','गोरखा','Gorkha',NULL,NULL,NULL),
        (37,4,'37','लम्जुङ','Lamjung',NULL,NULL,NULL),
        (38,4,'38','नवलपरासी (बर्दघाट सुस्ता पूर्व)','Nawalparasi (Bardhghat Susta East)',NULL,NULL,NULL),
        (39,4,'39','तनहुं','Tanahu',NULL,NULL,NULL),
        (40,4,'40','स्याङ्जा','Syangja',NULL,NULL,NULL),
        (41,4,'41','कास्की','Kaski',NULL,NULL,NULL),
        (42,4,'42','मनाङ','Manang',NULL,NULL,NULL),
        (43,4,'43','मुस्ताङ्ग','Mustang',NULL,NULL,NULL),
        (44,4,'44','म्यागदि','Myagdi',NULL,NULL,NULL),
        (45,4,'45','पर्वत','Parbat',NULL,NULL,NULL),
        (46,4,'46','बाग्लुङ्ग','Baglung',NULL,NULL,NULL),
        (47,5,'47','गुल्मी','Gulmi',NULL,NULL,NULL),
        (48,5,'48','पाल्पा','Palpa',NULL,NULL,NULL),
        (49,5,'49','रुपन्देही','Rupandehi',NULL,NULL,NULL),
        (50,5,'50','कपिलवस्तु','Kapilbastu',NULL,NULL,NULL),
        (51,5,'51','अर्घाखाँची','Arghakhanchi',NULL,NULL,NULL),
        (52,5,'52','प्यूठान','Pyuthan',NULL,NULL,NULL),
        (53,5,'53','रोल्पा','Rolpa',NULL,NULL,NULL),
        (54,5,'54','दाङ्ग','Dang',NULL,NULL,NULL),
        (55,5,'55','बाँके','Banke',NULL,NULL,NULL),
        (56,5,'56','बर्दिया','Bardiya',NULL,NULL,NULL),
        (57,5,'57','पुर्वि रुकुम','Eastern Rukum',NULL,NULL,NULL),
        (58,5,'58','नवलपरासी (बर्दघाट सुस्ता पश्चिम)','Nawalparasi (Bardhghat Susta West)',NULL,NULL,NULL),
        (59,6,'59','पश्चिम रुकुम','Western Rukum',NULL,NULL,NULL),
        (60,6,'60','सल्यान','Salyan',NULL,NULL,NULL),
        (61,6,'61','सुर्खेत','Surkhet',NULL,NULL,NULL),
        (62,6,'62','दैलेख','Dailekh',NULL,NULL,NULL),
        (63,6,'63','जाजरकोट','Jajarkot',NULL,NULL,NULL),
        (64,6,'64','डोल्पा','Dolpa',NULL,NULL,NULL),
        (65,6,'65','जुम्ला','Jumla',NULL,NULL,NULL),
        (66,6,'66','कालिकोट','Kalikot',NULL,NULL,NULL),
        (67,6,'67','मुगु','Mugu',NULL,NULL,NULL),
        (68,6,'68','हुम्ला','Humla',NULL,NULL,NULL),
        (69,7,'69','बाजुरा','Bajura',NULL,NULL,NULL),
        (70,7,'70','बझाङ्ग','Bajhang',NULL,NULL,NULL),
        (71,7,'71','अछाम','Achham',NULL,NULL,NULL),
        (72,7,'72','डोटी','Doti',NULL,NULL,NULL),
        (73,7,'73','कैलाली','Kailali',NULL,NULL,NULL),
        (74,7,'74','कंचनपुर','Kanchanpur',NULL,NULL,NULL),
        (75,7,'75','डडेलधुरा','Dadeldhura',NULL,NULL,NULL),
        (76,7,'76','बैतडि','Baitadi',NULL,NULL,NULL),
        (77,7,'77','दार्चुला','Darchula',NULL,NULL,NULL)";

        DB::insert($districts);
    }
}
