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
                'name' => 'INGÅR I INTENSIVKURSEN',
                'description' => '<ul>
                        <li>Riskettan</li>
                        <li>Risktvåan</li>
                        <li>Körkortsboken</li>
                        <li>Online teori</li>
                      </ul>',
                'price' => 3650,
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
                'price' => 10500,
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
                'price' => 14000,
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
                'price' => 17500,
                'image' => 'icon-3',
                'section' => Sections::INTENSIV_PAKET,
                'sort_index' => 4,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 5,
                'name' => 'ÖVNINGSPAKET',
                'description' => '<ul>
                        <li>5 Körlektioner</li>
                        <li>50 min per körlektion</li>
                        <li>Lånebil vid uppkörning</li>
                        <li>Manuell eller Automat</li>
                      </ul>',
                'price' => 3450,
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
                'image' => 'icon-4',
                'section' => Sections::OVNINGS_PAKET,
                'sort_index' => 8,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 9,
                'name' => 'TEORIUNDERVISNING',
                'description' => '<p>För dig som är intresserad av extra hjälp med teorin så erbjuder vi en personlig undervisning. En personlig plan utarbetas och undervisningen finns på fyra olika språk.</p>',
                'price' => 2000,
                'image' => 'icon-tjanster',
                'section' => Sections::OVRIGA_TJANSTER,
                'sort_index' => 9,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 10,
                'name' => 'SISTA MINUTEN',
                'description' => '<p>För dig som är intresserad av körlektioner för halva priset så erbjuder vi en sista minuten lista. Skriv in dig och få ett meddelande av oss när ett sådant tillfälle dyker upp.</p>',
                'price' => 395,
                'image' => 'icon-sista',
                'section' => Sections::OVRIGA_TJANSTER,
                'sort_index' => 10,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 11,
                'name' => 'KVÄLL/HELG',
                'description' => '<p>För dig som inte hinner med att övningsköra under veckodagarna mellan 07:00-18:00, får chansen att göra det med oss. Vi erbjuder kvälls- och helgkörning för 890 kr per körlektion.</p>',
                'price' => 890,
                'image' => 'icon-helg',
                'section' => Sections::OVRIGA_TJANSTER,
                'sort_index' => 11,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 12,
                'name' => 'LÅNEBIL',
                'description' => '<p>Lånebil gäller i 100 minuter, uppkörning inkl en övningslektion. Elever som inte är inskrivna i Västerort Trafikskola måste först bedömas vara lämpliga för en uppkörning.</p>',
                'price' => 1400,
                'image' => 'icon-lanebil',
                'section' => Sections::OVRIGA_TJANSTER,
                'sort_index' => 12,
                'start_date'=> null,
                'required_test_lesson' => 0,
            ],

            [
                'id' => 13,
                'name' => 'INTRODUKTIONSKURS',
                'description' => '<p>För dig som vill övningsköra privat är en introduktionskurs obligatorisk. Det gäller även den personen som du ska övningsköra med. Kursens mål är att öka förståelsen för trafiksäkerheten.</p>',
                'price' => 500,
                'image' => 'icon-kurser',
                'section' => Sections::KURSES,
                'sort_index' => 13,
                'start_date'=> strtotime('+2 days'),
                'required_test_lesson' => 0,
            ],

            [
                'id' => 14,
                'name' => 'Riskettan',
                'description' => '<p>En obligatorisk riskutbildning som kallas för Risk 1 för B-körkort. Med Risk 1 får du lära dig om riskerna med bland annat alkohol, droger och trötthet. Vi informerar även om dolda trafikrisker.</p>',
                'price' => 500,
                'image' => 'icon-kurser1',
                'section' => Sections::KURSES,
                'sort_index' => 14,
                'start_date'=> strtotime('+2 days'),
                'required_test_lesson' => 0,
            ],

            [
                'id' => 15,
                'name' => 'Risktvåan',
                'description' => '<p>En obligatorisk riskutbildning som även kallas för halkbana för B-körkort. Syftet med denna kurs är att du ska lära dig hantera riskfyllda situationer och manövrering på halt underlag.</p>',
                'price' => 1900,
                'image' => 'icon-kurser1',
                'section' => Sections::KURSES,
                'sort_index' => 15,
                'start_date'=> null,
                'required_test_lesson' => 1,
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