<?php
/** @var $model RegisterForm */
/** @var $this View */

/** @var $model Model */

use app\core\form\Field;
use app\core\Model;
use app\core\View;
use app\models\RegisterForm;

$this->title = "Sign Up"
?>
<!--begin:Sign Up Form-->
<div class="login-signup">
    <div class="text-center mb-10 mb-lg-20">
        <h3 class="">Sign Up</h3>
        <p class="text-muted font-weight-bold">Enter your details to create your account</p>
    </div>
    <form class="form text-left" id="kt_login_signup_form" method="post">
        <div class="form-group py-2 m-0">
            <?php echo new Field(
                $model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="{{label}}" name="{{name}}" value="{{value}}"/>',
                'fullname'
            ) ?>
        </div>
        <div class="form-group py-2 m-0 border-top">
            <?php echo new Field(
                $model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="{{label}}"
                   name="{{name}}" value="{{value}}" autocomplete="off"/>',
                'email'
            ) ?>
        </div>
        <div class="form-group py-2 m-0 border-top">
            <?php echo new Field(
                $model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="{{label}}"
                   name="{{name}}" value="{{value}}"/>',
                'password'
            ) ?>
        </div>
        <div class="form-group py-2 m-0 border-top">
            <?php echo new Field(
                $model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                   placeholder="{{label}}" name="{{name}}" value="{{value}}"/>',
                'passwordConfirm'
            ) ?>
        </div>
        <div class="form-group d-flex flex-wrap flex-center">
            <button id="kt_login_signup_submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
            <a href="/signin" class="btn btn-outline-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Already have an account?</a>
        </div>
    </form>
</div>
<!--end:Sign Up Form-->