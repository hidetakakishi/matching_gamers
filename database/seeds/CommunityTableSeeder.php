<?php

use Illuminate\Database\Seeder;

class CommunityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = 'https://matchinggamers.s3.ap-northeast-1.amazonaws.com/community/community_noimage.jpeg';
        DB::table('community')->insert([
        [
          'community_name' => 'apex',
          'community_image' => $image,
          'community_members' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'community_name' => 'ava',
          'community_image' => $image,
          'community_members' => 2,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'community_name' => 'バイオ',
          'community_image' => $image,
          'community_members' => 3,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'community_name' => 'アメリカ',
          'community_image' => $image,
          'community_members' => 10,
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
