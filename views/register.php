<h1>Register</h1>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname', 'text', 'Firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname', 'text', 'Lastname') ?>
    </div>
</div>
<?php echo $form->field($model, 'email', 'email', 'Email') ?>
<?php echo $form->field($model, 'password', 'password', 'Password') ?>
<?php echo $form->field($model, 'passwordConfirm', 'password', 'Confirm password') ?>
<button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
<?php \app\core\form\Form::end() ?>
<!--<form action="" method="post">-->
<!--    <div class="row form-group">-->
<!--        <div class="col">-->
<!--            <label for="firstnameInput">-->
<!--                Firstname-->
<!--            </label>-->
<!--            <input type="text" class="form-control" name="firstname" id="firstnameInput">-->
<!--        </div>-->
<!--        <div class="col">-->
<!--            <label for="lastnameInput">-->
<!--                Lastname-->
<!--            </label>-->
<!--            <input type="text" class="form-control" name="lastname" id="lastnameInput">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="emailInput">-->
<!--            Email-->
<!--        </label>-->
<!--        <input type="email" class="form-control" name="email" id="emailInput">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="passwordInput">-->
<!--            Password-->
<!--        </label>-->
<!--        <input type="password" class="form-control" name="password" id="passwordInput">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="passwordConfirmInput">-->
<!--            Confirm password-->
<!--        </label>-->
<!--        <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirmInput">-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>-->
<!--</form>-->