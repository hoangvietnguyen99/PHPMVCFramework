<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exception\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\middlewares\AuthMiddleware;
use app\models\User;
use MongoDB\BSON\ObjectId;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['account', 'ChangePassword']));
    }
    public function getProfile(Request $request, Response $response)
    {
        $userId = $request->query['id'] ?? null;
        if ($userId) {
            if ((Application::$application->user)->getId() === $userId) {
                return $response->redirect('/profile');
            }
            $user = User::findOne(['_id' => new ObjectId($userId)]);
            if (!$user) throw new NotFoundException();
            return $this->render('profile', ['user' => $user]);
        }
    }
    public function account()
    {
        $user =  Application::$application->user;
        if (!$user) throw new NotFoundException();
        return $this->render('profile', ['user' => $user]);
    }
    public function ChangePassword(Request $request, Response $response)
    {
        if ($request->getMethod() === 'post') {
            $user =  Application::$application->user;
            // $old_password = $request->body['old_password'];
            if (isset($request->body['old_password'])) {
                $old_password = $request->body['old_password'];
                if (password_verify($old_password, $user->password)) {
                    $elements = '<input type="password" name="new_password" class="form-control" id="new_password" placeholder="new Password" />
                    <div class="fv-plugins-message-container" id="new_pass_isEmpty" style="display: none;margin-top: 10px;">
                        <div data-field="password" data-validator="notEmpty" class="fv-help-block">New password is required</div>
                    </div>
                    <input style="margin-top: 20px;" type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="confirm password" />
                    <div class="fv-plugins-message-container" id="confirm_pass_isEmpty" style="display: none;margin-top: 10px;">
                        <div data-field="password" data-validator="notEmpty" class="fv-help-block">Confirm password is required</div>
                    </div>
                    ';
                    $results = array('type' => 'verify', 'status' => true, 'elements' => $elements);
                } else {
                    $results = array('type' => 'verify', 'status' => false);
                }
                $response->send(200, $results);
            }
            if (isset($request->body['new_password'])) {
                // $new_pass = password_hash($request->body['new_password'], PASSWORD_DEFAULT);
                // $user->password = $new_pass;
                // $user->insertOrUpdateOne();
                $results = array('type' => 'changed', 'status' => true);
                $response->send(200, $results);
            }
        }
    }
}
