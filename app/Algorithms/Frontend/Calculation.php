<?php

namespace App\Algorithms\Frontend;

class Calculation
{
    private const SERVICE_PERCENT = 5; // сделать конфиг и вынести

    private $command_home_name = 'ГазМяс';
    private $command_guest_name = 'БАТЭ';

    private $command_home_goals = 0;
    private $command_guest_goals = 0;


    private $win1 = []; // кто поставил на 1ую команду
    private $win2 = []; // кто поставил на 2ую команду
    private $draw = []; // кто поставил на ничью

    private $bet_sum = 0; // сумма поищравших старон (2 из 3)
    private $winner_sum = 0; // сумма поумолчанию группы которая победила
    private $service_sum = 0; // отчисления сервису

    private $winner_link; // храним ссылку на массив победителя

    public function __construct($win1, $win2, $draw)
    {

        $this->win1 = $win1;

        $this->win2 = $win2;

        $this->draw = $draw;

        $this->command_home_goals = rand(0,5);
        $this->command_guest_goals = rand(0,5);

        $this->printPlayers(); // отрисовка ставок игроков

        $this->render();

        $this->printGameScore(); // отрисовка счета (случайно)
        $this->printServiceSum(); // отрисовка нашей суммы

        $this->printResults(); // отрисовка результат после расчета для победителей

    }



    private function render()
    {
        if ($this->command_home_goals > $this->command_guest_goals) { // home

            $this->winner_link = &$this->win1;
            $this->bet_sum = array_sum($this->win2) + array_sum($this->draw);
            $this->winner_sum = array_sum($this->win1);

        } elseif ($this->command_home_goals < $this->command_guest_goals) { // guest

            $this->winner_link = &$this->win2;
            $this->bet_sum = array_sum($this->win1) + array_sum($this->draw);
            $this->winner_sum = array_sum($this->win2);

        } else { // draw

            $this->winner_link = &$this->draw;
            $this->bet_sum = array_sum($this->win1) + array_sum($this->win2);
            $this->winner_sum = array_sum($this->draw);

        }

        $this->saveToService();
        foreach ($this->winner_link as $user => $sum) {
            $this->winner_link[$user] = $sum / $this->winner_sum * $this->bet_sum + $sum;
        }

    }


/*
    private function render()
    {
        if ($this->command_home_goals > $this->command_guest_goals) { // home

            $this->bet_sum += array_sum($this->win2);
            $this->bet_sum += array_sum($this->draw);
            $this->winner_sum = array_sum($this->win1);
            $this->saveToService();
            foreach ($this->win1 as $user => $sum) {
                $this->win1[$user]  = $sum / $this->winner_sum * $this->bet_sum + $sum;
            }
            $this->winner_link = &$this->win1;


        } elseif ($this->command_home_goals < $this->command_guest_goals) { // guest

            $this->bet_sum += array_sum($this->win1);
            $this->bet_sum += array_sum($this->draw);
            $this->winner_sum = array_sum($this->win2);
            $this->saveToService();
            foreach ($this->win2 as $user => $sum) {
                $this->win2[$user]  = $sum / $this->winner_sum * $this->bet_sum + $sum;
            }
            $this->winner_link = &$this->win2;

        } else { // draw

            $this->bet_sum += array_sum($this->win1);
            $this->bet_sum += array_sum($this->win2);
            $this->winner_sum = array_sum($this->draw);
            $this->saveToService();
            foreach ($this->draw as $user => $sum) {
                $this->draw[$user]  = $sum / $this->winner_sum * $this->bet_sum + $sum;
            }
            $this->winner_link = &$this->draw;

        }

    }
*/

    private function saveToService()
    {
        $this->service_sum = $this::SERVICE_PERCENT * $this->bet_sum / 100;

        $this->bet_sum -=  $this->service_sum;

        // save to DB
    }


    // временные функции печати
    /**********************
     ***********************
     ***********************
     ***********************
     */
    // printed functions
    private function printPlayers()
    {
        echo 'Поставили на победу команды 1:';
        echo "<pre>";
        print_r($this->win1);
        echo "</pre>";
        echo 'Поставили на ничью:';
        echo "<pre>";
        print_r($this->draw);
        echo "</pre>";
        echo 'Поставили на победу команды 2:';
        echo "<pre>";
        print_r($this->win2);
        echo "</pre>";
    }


    private function printGameScore()
    {
        echo
            $this->command_home_name . ' ' .
            $this->command_home_goals . ' - ' .
            $this->command_guest_goals . ' '.
            $this->command_guest_name . "<br>";
    }

    private function printServiceSum()
    {
        echo "Наши бабки: " . $this->service_sum . "<br>";
    }

    private function printResults()
    {
        echo 'Победители';
        echo "<pre>";
        print_r($this->winner_link);
        echo "</pre>";
    }

}
