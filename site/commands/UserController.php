<?php
namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\ConflictHttpException;

class UserController extends Controller
{
    public function actionAdd($username, $password)
    {
        $user = User::findOne(['username' => $username]);
        if ($user) {
            throw new ConflictHttpException('Such user already exists');
        }
        $user = new User([
            'username' => $username,
        ]);
        $user->setPassword($password);
        $user->generateAuthKey();
        if (! $user->save()) {
            print_r($user->errors);
            return ExitCode::DATAERR;
        }

        echo "User created\n";
        return ExitCode::OK;
    }
}