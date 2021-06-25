<?php
/** @var $this View */
/** @var $model ForgetPasswordForm */

use app\core\form\Field;
use app\core\View;
use app\models\ForgetPasswordForm;

$this->title = 'Forgot';
$this->scripts[] = '<script type="application/javascript">
"use strict";

// Class Definition
var KTLogin = function() {

	var _handleFormForgot = function() {
		var form = KTUtil.getById("kt_login_forgot_form");

		if (!form) {
			return;
		}

		FormValidation
		    .formValidation(
		        form,
		        {
		            fields: {
						email: {
							validators: {
								notEmpty: {
									message: "Email is required"
								},
								emailAddress: {
									message: "The value is not a valid email address"
								}
							}
						}
		            },
		            plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
						//	eleInvalidClass: "", // Repace with uncomment to hide bootstrap validation icons
						//	eleValidClass: "",   // Repace with uncomment to hide bootstrap validation icons
						})
		            }
		        }
		    )
			.on("core.form.invalid", function() {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					KTUtil.scrollTop();
				});
		    });
    }

    // Public Functions
    return {
    init: function() {
        _handleFormForgot();
    }
};
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
</script>';
?>
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside Header-->
                <a href="#" class="login-logo text-center pt-lg-25 pb-10">
                    <img src="assets/media/logos/logo-1.png" class="max-h-70px" alt=""/>
                </a>
                <!--end::Aside Header-->
                <!--begin::Aside Title-->
                <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">User Experience
                    &amp; Interface Design
                    <br/>Strategy SaaS Solutions</h3>
                <!--end::Aside Title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
                 style="background-position-y: calc(100% + 5rem); background-image: url(assets/media/svg/illustrations/login-visual-5.svg)"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-column-fluid d-flex flex-column p-10">
            <!--begin::Top-->
            <div class="text-right d-flex justify-content-center">
                <div class="top-forgot text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                    <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2" id="kt_login_signup">Get
                        Help</a>
                </div>
            </div>
            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Forgot-->
                <div class="login-form">
                    <!--begin::Form-->
                    <form class="form" id="kt_login_forgot_form" action="" method="post">
                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgotten Password
                                ?</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your
                                password</p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <?PHP
                            echo new Field($model, '<input class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="email"
                                   placeholder="{{label}}" name="{{name}}" value="{{value}}" autocomplete="off"/>', 'email')
                            ?>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap">
                            <button type="submit" id="kt_login_forgot_form_submit_button"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit
                            </button>
                            <a href="custom/pages/login/login-3/signin.html" id="kt_login_forgot_cancel"
                               class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Forgot-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>