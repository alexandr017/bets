<?php

use Illuminate\Database\Seeder;
use App\Models\Football\FootballCategory;
use App\Models\Football\FootballTour;

class FootballSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new FootballCategory([
            'category_title' => 'Лига чемпионов 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Лига Европы 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Кубок Долбоъебов 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Испании 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Англии 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Италии 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Германии 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Франции 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат России 2019/2020'
        ]);
        $category->save();

        $category = new FootballCategory([
            'category_title' => 'Чемпионат Туркмениста 2019/2020'
        ]);
        $category->save();





        $championsLeague = [
            '1 Тур',
            '2 Тур',
            '3 Тур',
            '4 Тур',
            '5 Тур',
            '6 Тур',
            '1/8 Финала',
            '1/4 Финала',
            'Полуфинал',
            'Финал'
        ];

        foreach ($championsLeague as $tourLeague) {
            $tour =  new FootballTour([
                'football_category_id' => 1,
                'tour_title' => $tourLeague
            ]);
            $tour->save();
        }

        for ($i = 1; $i <= 38; $i++) {
            $tour =  new FootballTour([
                'football_category_id' => 4,
                'tour_title' => $i
            ]);
            $tour->save();
            $tour =  new FootballTour([
                'football_category_id' => 5,
                'tour_title' => $i
            ]);
            $tour->save();
            $tour =  new FootballTour([
                'football_category_id' => 6,
                'tour_title' => $i
            ]);
            $tour->save();
        }





    }
}
