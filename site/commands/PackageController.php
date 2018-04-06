<?php
namespace app\commands;

use app\models\Package;
use app\models\Sections;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class PackageController extends Controller
{
    public function  actionSeed()
    {
        $data = [
            [
                'id' => 1,
                'name' => '-',
                'description' => '<ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>',
                'price' => 590,
                'sale_price' => 500,
                'sale_percent' => 15,
                'image' => 'icon-time',
                'section' => Sections::INTENSIV_PAKET,
                'sort_index' => 1,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 2,
                'name' => 'INTENSIVPAKET 1 VECKA',
                'description' => '<ul>
                        <li>10 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 6900,
                'sale_price' => 4800,
                'sale_percent' => 20,
                'image' => 'icon-1',
                'section' => Sections::INTENSIV_PAKET,
                'sort_index' => 2,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 3,
                'name' => 'INTENSIVPAKET 2 VECKOR',
                'description' => '<ul>
                        <li>15 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 10400,
                'sale_price' => 7700,
                'sale_percent' => 25,
                'image' => 'icon-2',
                'section' => Sections::INTENSIV_PAKET,
                'sort_index' => 3,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 4,
                'name' => 'INTENSIVPAKET 3 VECKOR',
                'description' => '<ul>
                        <li>20 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 138900,
                'sale_price' => 7700,
                'sale_percent' => 30,
                'image' => 'icon-3',
                'section' => Sections::INTENSIV_PAKET,
                'sort_index' => 4,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 5,
                'name' => '-',
                'description' => '<ul>
                        <li>Riskettan</li>
                        <li>Risktvåan</li>
                        <li>Körkortsboken</li>
                        <li>Online teori</li>
                      </ul>',
                'price' => 3650,
                'sale_price' => 3100,
                'sale_percent' => 15,
                'image' => 'icon-1',
                'section' => Sections::OVNINGS_PAKET,
                'sort_index' => 5,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 6,
                'name' => 'ÖVNINGSPAKET',
                'description' => '<ul>
                        <li>10 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 6700,
                'sale_price' => 5700,
                'sale_percent' => 15,
                'image' => 'icon-2',
                'section' => Sections::OVNINGS_PAKET,
                'sort_index' => 6,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 7,
                'name' => 'ÖVNINGSPAKET',
                'description' => '<ul>
                        <li>15 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 9900,
                'sale_price' => 8400,
                'sale_percent' => 15,
                'image' => 'icon-3',
                'section' => Sections::OVNINGS_PAKET,
                'sort_index' => 7,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 8,
                'name' => 'ÖVNINGSPAKET',
                'description' => '<ul>
                        <li>20 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 13000,
                'sale_price' => 1100,
                'sale_percent' => 15,
                'image' => 'icon-4',
                'section' => Sections::OVNINGS_PAKET,
                'sort_index' => 8,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 9,
                'name' => '-',
                'description' => '<ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>',
                'price' => 0,
                'sale_price' => 0,
                'sale_percent' => 0,
                'image' => 'icon-',
                'section' => Sections::STUDENT_PAKET,
                'sort_index' => 9,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],
            [
                'id' => 10,
                'name' => '-',
                'description' => '<ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>',
                'price' => 590,
                'sale_price' => 470,
                'sale_percent' => 20,
                'image' => 'icon-1',
                'section' => Sections::STUDENT_PAKET,
                'sort_index' => 9,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],
            [
                'id' => 11,
                'name' => 'BASPAKET',
                'description' => '<ul>
                        <li>3 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li></li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 2070,
                'sale_price' => 1380,
                'sale_percent' => 33,
                'image' => 'icon-2',
                'section' => Sections::STUDENT_PAKET,
                'sort_index' => 11,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],
            [
                'id' => 12,
                'name' => 'KICKDOWN',
                'description' => '<ul>
                        <li>5 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li></li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 3400,
                'sale_price' => 2700,
                'sale_percent' => 25,
                'image' => 'icon-2',
                'section' => Sections::STUDENT_PAKET,
                'sort_index' => 12,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],
        ];

        $transaction = Yii::$app->db->beginTransaction();
        foreach ($data as $item) {
            $package = Package::findOne($item['id']);
            if (! $package) {
                $package = new Package($item);
            } else {
                $package->load($item,'');
            }
            if (! $package->save()) {
                print_r($package->getErrors());
                $transaction->rollBack();
                return ExitCode::DATAERR;
            }
        }
        $transaction->commit();

        return ExitCode::OK;
    }
}