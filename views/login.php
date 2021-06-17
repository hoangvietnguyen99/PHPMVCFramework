<?php
/** @var $model LoginForm */

/** @var $this View */

use app\core\form\Field;
use app\core\View;
use app\models\LoginForm;

$this->title = 'Sign In';
?>
<!--begin:Sign In Form-->
<div class="login-signin">
    <div class="text-center mb-10 mb-lg-20">
        <h2 class="font-weight-bold">Sign In</h2>
        <p class="text-muted font-weight-bold">Enter your username and password</p>
    </div>
    <form class="form text-left" id="kt_login_signin_form" method="post">
        <div class="form-group py-2 m-0">
            <?php echo new Field($model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="{{label}}"
                   name="{{name}}" value="{{value}}" autocomplete="off"/>', 'email') ?>
        </div>
        <div class="form-group py-2 border-top m-0">
            <?php echo new Field($model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="{{label}}"
                   name="{{name}}" value="{{value}}"/>', 'password') ?>
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-5">
            <div class="checkbox-inline">
                <label class="checkbox m-0 text-muted font-weight-bold">
                    <input type="checkbox" name="remember"/>
                    <span></span>Remember me</label>
            </div>
            <a href="/forgetpassword" class="text-muted text-hover-primary font-weight-bold">Forget Password ?</a>
        </div>
        <div class="text-center mt-15">
            <button id="kt_login_signin_submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">
                Sign In
            </button>
        </div>
    </form>
</div>
<!--end:Sign In Form-->