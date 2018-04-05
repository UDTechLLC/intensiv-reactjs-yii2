<?php
namespace app\commands;

use app\models\School;
use app\models\Sections;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class SchoolController extends Controller
{
    public function  actionSeed()
    {
        $data = [
            [
                'id' => 1,
                'title' => 'Jakobsberg',
                'info' => 'Förarprov för personbil',
                'address' => 'Hästskovägen 88, 177 39 Järfälla',
                'lat' => 59.425769,
                'lng' => 17.841754,
            ],
            [
                'id' => 2,
                'title' => 'Sollentuna',
                'info' => 'Förarprov för personbil',
                'address' => 'Djupdalsvägen 12, 192 51 Sollentuna',
                'lat' => 59.444888,
                'lng' => 17.948930,
            ],
            [
                'id' => 3,
                'title' => 'Farsta',
                'info' => 'Förarprov för personbil',
                'address' => 'Fryksdalsbacken 12, 123 43 Farsta',
                'lat' => 59.237217,
                'lng' =>  18.111088,
            ],
            [
                'id' => 4,
                'title' => 'Vallentuna',
                'info' => 'Förarprov för A, A1, A2, UB & BE',
                'address' => 'GILLINGE 1, 186 91 Vallentuna',
                'lat' => 59.508297,
                'lng' => 18.176236,
            ],
            [
                'id' => 5,
                'title' => 'Tullinge',
                'info' => 'Förarprov för A, A1, A2, UB & BE',
                'address' => 'Annabergsvägen 36, 146 34 Tullinge',
                'lat' => 59.185060,
                'lng' => 17.917802,
            ],
            [
                'id' => 6,
                'title' => 'Stockholm City',
                'info' => 'Kunskapsprov',
                'address' => 'Västra Järnvägsgatan 7, 111 64 Stockholm',
                'lat' => 59.331455,
                'lng' => 18.053550,
            ],
            [
                'id' => 7,
                'title' => 'Västerort Trafikskola',
                'info' => 'Personbil',
                'address' => 'Grimstagatan 160, 162 58 Vällingby',
                'lat' => 59.361873,
                'lng' => 17.865430,
            ],
        ];


        $transaction = Yii::$app->db->beginTransaction();
        foreach ($data as $item) {
            $school = School::findOne($item['id']);
            if (! $school) {
                $school = new School($item);
            } else {
                $school->load($item,'');
            }
            if (! $school->save()) {
                print_r($school->getErrors());
                $transaction->rollBack();
                return ExitCode::DATAERR;
            }
        }
        $transaction->commit();

        return ExitCode::OK;
    }
}