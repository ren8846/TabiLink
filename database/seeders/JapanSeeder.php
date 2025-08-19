<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JapanSeeder extends Seeder
{
    public function run()
    {
        // Japanテーブルにサンプルデータを挿入
        DB::table('japans')->insert([
            [
                'district' => '関東',
                'prefecture' => '東京',
                'facility_name' => '施設A',
                'salary' => 500000,
                'site' => 'https://example.com',
                'url' => 'https://example.com',
                'image_url' => 'https://via.placeholder.com/150',
                'world_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'district' => '関西',
                'prefecture' => '大阪',
                'facility_name' => '施設B',
                'salary' => 450000,
                'site' => 'https://example.com',
                'url' => 'https://example.com',
                'image_url' => 'https://via.placeholder.com/150',
                'world_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
    // 北海道
    ['district'=>'北海道','prefecture'=>'北海道','facility_name'=>'施設Hokkaido','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 東北
    ['district'=>'東北',
    'prefecture'=>'青森',
    'facility_name'=>'施設Aomori',
    'salary'=>380000,
    'site'=>'https://example.com',
    'url'=>'https://example.com',
    'image_url'=>'https://via.placeholder.com/150',
    'world_id'=>1,
    'created_at'=>now(),
    'updated_at'=>now()
],
    ['district'=>'東北','prefecture'=>'岩手','facility_name'=>'施設Iwate','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'東北','prefecture'=>'宮城','facility_name'=>'施設Miyagi','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'東北','prefecture'=>'秋田','facility_name'=>'施設Akita','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'東北','prefecture'=>'山形','facility_name'=>'施設Yamagata','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'東北','prefecture'=>'福島','facility_name'=>'施設Fukushima','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 関東
    ['district'=>'関東','prefecture'=>'茨城','facility_name'=>'施設Ibaraki','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'栃木','facility_name'=>'施設Tochigi','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'群馬','facility_name'=>'施設Gunma','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'埼玉','facility_name'=>'施設Saitama','salary'=>420000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'千葉','facility_name'=>'施設Chiba','salary'=>420000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'東京','facility_name'=>'施設Tokyo','salary'=>500000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'関東','prefecture'=>'神奈川','facility_name'=>'施設Kanagawa','salary'=>480000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 北陸東海
    ['district'=>'北陸東海','prefecture'=>'新潟','facility_name'=>'施設Niigata','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'富山','facility_name'=>'施設Toyama','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'石川','facility_name'=>'施設Ishikawa','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'福井','facility_name'=>'施設Fukui','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'山梨','facility_name'=>'施設Yamanashi','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'長野','facility_name'=>'施設Nagano','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'岐阜','facility_name'=>'施設Gifu','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'静岡','facility_name'=>'施設Shizuoka','salary'=>420000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'北陸東海','prefecture'=>'愛知','facility_name'=>'施設Aichi','salary'=>450000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 近畿
    ['district'=>'近畿','prefecture'=>'三重','facility_name'=>'施設Mie','salary'=>410000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'滋賀','facility_name'=>'施設Shiga','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'京都','facility_name'=>'施設Kyoto','salary'=>450000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'大阪','facility_name'=>'施設Osaka','salary'=>450000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'兵庫','facility_name'=>'施設Hyogo','salary'=>440000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'奈良','facility_name'=>'施設Nara','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'近畿','prefecture'=>'和歌山','facility_name'=>'施設Wakayama','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 中国
    ['district'=>'中国','prefecture'=>'鳥取','facility_name'=>'施設Tottori','salary'=>370000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'中国','prefecture'=>'島根','facility_name'=>'施設Shimane','salary'=>370000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'中国','prefecture'=>'岡山','facility_name'=>'施設Okayama','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'中国','prefecture'=>'広島','facility_name'=>'施設Hiroshima','salary'=>420000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'中国','prefecture'=>'山口','facility_name'=>'施設Yamaguchi','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 四国
    ['district'=>'四国','prefecture'=>'徳島','facility_name'=>'施設Tokushima','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'四国','prefecture'=>'香川','facility_name'=>'施設Kagawa','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'四国','prefecture'=>'愛媛','facility_name'=>'施設Ehime','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'四国','prefecture'=>'高知','facility_name'=>'施設Kochi','salary'=>370000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 九州
    ['district'=>'九州','prefecture'=>'福岡','facility_name'=>'施設Fukuoka','salary'=>420000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'佐賀','facility_name'=>'施設Saga','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'長崎','facility_name'=>'施設Nagasaki','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'熊本','facility_name'=>'施設Kumamoto','salary'=>390000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'大分','facility_name'=>'施設Oita','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'宮崎','facility_name'=>'施設Miyazaki','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
    ['district'=>'九州','prefecture'=>'鹿児島','facility_name'=>'施設Kagoshima','salary'=>380000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],

    // 沖縄
    ['district'=>'沖縄','prefecture'=>'沖縄','facility_name'=>'施設Okinawa','salary'=>400000,'site'=>'https://example.com','url'=>'https://example.com','image_url'=>'https://via.placeholder.com/150','world_id'=>1,'created_at'=>now(),'updated_at'=>now()],
]);
        
    }
}