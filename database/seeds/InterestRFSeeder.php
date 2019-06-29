<?php

use Illuminate\Database\Seeder;

class InterestRFSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $interests = array(
            "IT", "경제", "연예", "연애", "교통", "건강 및 운동", "음식",
            "여행", "음악", "공연", "영화", "사회", "역사", "정치", "과학",
            "종교", "시사", "패션", "아이 및 육아", "헤어 및 뷰티", "동물",
            "식물", "게임", "소설", "교육", "만화", "외국어");

        foreach ($interests as $interest){
            DB::table('INTEREST_RF')->insert([
                'i_interest' => $interest
            ]);
        }
    }
}
