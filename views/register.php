<h2>Register</h2>

<form action="" method="post">
    <div class="row form-group">
        <div class="col"> Firstname
            <label for="firstnameInput">
                Firstname
            </label>
            <input type="text" class="form-control" name="firstname" id="firstnameInput">
        </div>
        <div class="col">
            <label for="lastnameInput">
                Lastname
            </label>
            <input type="text" class="form-control" name="lastname" id="lastnameInput">
        </div>
    </div>
    <div class="form-group"> Email
        <label for="emailInput">
            Email
        </label>
        <input type="email" class="form-control" name="email" id="emailInput">
    </div>
    <div class="form-group">
        <label for="passwordInput">
            Password
        </label>
        <input type="password" class="form-control" name="password" id="passwordInput">
    </div>
    <div class="form-group">
        <label for="confirmPasswordInput">
            Confirm password
        </label>
        <input type="password" class="form-control" name="confirmPassword" id="confirmPasswordInput">
    </div>
    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
</form>