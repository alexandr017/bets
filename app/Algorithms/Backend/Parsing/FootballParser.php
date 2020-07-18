<?php

namespace App\Algorithms\Backend\Parsing;
use DiDom\Document;

class FootballParser
{
    /**
     * @var
     */
    private $link;

    /**
     * @var array
     */
    private $months = [];

    /**
     * @var array
     */
    private $date = [];

    /**
     * FootballParser constructor.
     * @param $link
     */
    public function __construct($link, $months = [8,9,10,11,12,1,2,3,4,5,6] )
    {
        $this->link = $link;
        $this->months = $months;
    }

    public function render()
    {
        // проходимся по месяцам
        foreach ($this->months as $month) {

            $link = $this->link . "&m=$month";

            $document = new Document($link, true);

            $toures = $document->find('.titleH3'); // название туров
            $tables = $document->find('.stat-table'); // расписание по турам

            if (count($toures) !== count($tables)) {
                abort(504);
            }

            // проходимся по турам
            foreach ($toures as $key => $tour) {
                if (!isset($tables[$key])) {
                    abort(504);
                }
                $this->data[$tour->text()] = $this->getTourMatches($tables[$key]);
            }

            return $this->data;


        }
    }

    private function getTourMatches($tour)
    {
        $tr = $tour->find('tbody tr');

        $result = [];

        foreach ($tr as $tr_) {

            $home = $tr_->find('.owner-td a');
            $guest = $tr_->find('.guests-td a');

            if(! isset($home[0]) || !(isset($guest[0]))) {
                abort(505);
            }

            $result [] = [
                'home' => $home[0]->text(),
                'guest' => $guest[0]->text()
            ];

        }

        return $result;

    }


}
