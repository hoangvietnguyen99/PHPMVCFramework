<?php
/** @var $this View */

/** @var $model Model */

use app\core\form\Field;
use app\core\Model;
use app\core\View;

$this->title = 'Forget Password'
?>
<!--begin:Forgot Password Form-->
<div class="login-forgot">
    <div class="text-center mb-10 mb-lg-20">
        <h3 class="">Forgotten Password ?</h3>
        <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
    </div>
    <form class="form text-left" id="kt_login_forgot_form" method="post">
        <div class="form-group py-2 m-0 border-bottom">
            <?php echo new Field(
                $model,
                '<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="{{label}}" name="{{name}}" autocomplete="off" value="{{value}}"/>',
                'email'
            ) ?>
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button id="kt_login_forgot_submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">
                Submit
            </button>
        </div>
    </form>
</div>
<!--end:Forgot Password Form-->
