<?PHP

/** @var $this View */

use app\core\View;
use app\core\Application;

$this->title = 'Profile';
?>
<!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Details-->
                    <div class="d-flex mb-9">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img src="<?php echo htmlspecialchars_decode($user->imgPath); ?>" alt="image" />
                            </div>
                            <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                <div class="d-flex mr-3">
                                    <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?php echo $user->name ?></a>
                                    <a href="#">
                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                    </a>
                                </div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex flex-wrap justify-content-between mt-1">
                                <div class="d-flex flex-column flex-grow-1 pr-8">
                                    <div class="d-flex flex-wrap mb-4">
                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-new-email mr-2 font-size-lg"></i><?php echo $user->email; ?></a>
                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?php echo $user->role; ?></a>
                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                            <i class="fas fa-transgender icon-md" style="padding-right: 3px;"></i><?php echo $user->gender; ?></a>
                                    </div>
                                    <div class="d-flex flex-wrap mb-4">
                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" style="margin-top: 8px;">
                                            <i class="fas fa-birthday-cake mr-2 font-size-lg"></i><?php echo ($user->dateOfBirth)->format('Y-m-d'); ?></a>
                                        <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" style="margin-top: 8px;">
                                            <i class="flaticon2-phone mr-2 font-size-lg"></i><?php echo $user->phone; ?></a>
                                        <!-- <a href="#" data-toggle="modal" data-target="#Modal-ChangePass" class="text-dark-50 text-hover-primary font-weight-bold">
                                            <i class="flaticon-settings mr-2 font-size-lg mr-2 font-size-lg"></i>Change password</a> -->
                                        <button type="button" data-toggle="modal" data-target="#Modal-ChangePass" <?php $user_session = Application::$application->user;
                                                                                                                    if ($user_session === null || $user_session->getId() != $user->getId()) {
                                                                                                                        echo ' style="display:none;" ';
                                                                                                                    } ?> class="btn btn-primary">Change password</button>
                                        <div class="modal fade" id="Modal-ChangePass" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="form-password-change" name="form-changepass">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password" />
                                                                    <div class="fv-plugins-message-container" style="display: none;margin-top: 10px;">
                                                                        <div data-field="password" data-validator="notEmpty" class="fv-help-block"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                        <button type="submit" form="form-password-change" class="btn btn-primary font-weight-bold">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Items-->
                    <div class="d-flex align-items-center flex-wrap mt-8">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-questions-circular-button display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Total question</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <?php echo $user->totalQuestions; ?></span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon2-writing display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Total answers</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <?php echo $user->totalAnswers; ?></span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Tier</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <?php echo $user->tier ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Score</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <?php echo $user->score ?></span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-star display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column flex-lg-fill">
                                <span class="text-dark-75 font-weight-bolder font-size-sm">Average rate</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <?php echo $user->averageRate ?></span>
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--begin::Items-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script type="application/javascript">
    $('document').ready(() => {
        $('#form-password-change').on('submit', function(event) {
            event.preventDefault();
            var serialize = $(this).serialize();
            var input_old_password = $("#old_password");
            var input_new_passord = $("#new_password");
            var input_confirm_pass = $("#confirm_password");
            if (input_old_password.length > 0 && input_old_password.val() == "") {
                var label_verify_pass = $(".fv-plugins-message-container");
                (label_verify_pass.find(".fv-help-block")).html("Password is required");
                label_verify_pass.css('display', 'block');
            } else if (input_new_passord.length > 0 && input_new_passord.val() == "") {
                $("#new_pass_isEmpty").css('display', 'block');
            } else if (input_confirm_pass.length > 0 && input_confirm_pass.val() == "") {
                $("#confirm_pass_isEmpty").css('display', 'block');
            } else if (input_new_passord.length > 0 && input_new_passord.val() != "" && input_confirm_pass.length > 0 && input_confirm_pass.val() != "" && input_new_passord.val() != input_confirm_pass.val()) {
                ($("#confirm_pass_isEmpty").find(".fv-help-block")).html("Please make sure your passwords match");
                $("#confirm_pass_isEmpty").css('display', 'block');
            } else {
                $.ajax({
                    url: '/account/change-password',
                    method: 'POST',
                    data: serialize,
                    dataType: 'json',
                    success: function(results) {
                        if (results.type == 'verify') {
                            if (results.status == true) {
                                ($("#form-password-change").find('.form-group')).html(results.elements);
                            } else {
                                ($(".fv-plugins-message-container").find(".fv-help-block")).html("Incorrect password");
                                $(".fv-plugins-message-container").css('display', 'block');
                            }
                        }
                        if (results.type == "changed" && results.status == true) {
                            $("#Modal-ChangePass").modal('hide');
                            notify("Password was changed");
                        }
                    },
                });
            }
        });
        $(".form-group").on('click', '.form-control', function(e) {
            $(".fv-plugins-message-container").css('display', 'none');
        });
        $("#Modal-ChangePass").on('hidden.bs.modal', function(e) {
            $("#kt_body").css("padding-right", "0px");
            var verify_pass = '<input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password" /><div class="fv-plugins-message-container" style="display: none;margin-top: 10px;"><div data-field="password" data-validator="notEmpty" class="fv-help-block"></div></div>';
            ($("#form-password-change").find('.form-group')).html(verify_pass);
            $(".modal-backdrop").remove();

        })

        function notify(text) {
            var notify_element = '<div style="position: fixed;z-index:100;top:27px;left:40%;right:40%;height:68px" class="alert alert-custom alert-light-primary fade show mb-5" role="alert"><div class="alert-icon"><i class="far fa-check-circle"></i></div><div class="alert-text">' + text + '</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>';
            $("#kt_body").append(notify_element);
            var promise = new Promise(function(resolve, reject) {
                setTimeout(() => {
                    $('.alert').css('-webkit-animation', 'fadeOut 5000ms');
                    resolve();
                }, 3000);
            });
            promise.then(function() {
                setTimeout(function() {
                    $('.alert').remove();
                }, 5000)
            });
        }
    });
</script>