<?php
/** @var $this View */

/** @var $model RegisterForm */

use app\constants\Path;
use app\core\form\Field;
use app\core\View;
use app\models\RegisterForm;

$this->title = 'Register';
$this->scripts[] = '<script type="application/javascript">
    // Class definition

    var KTBootstrapDatepicker = function () {

        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: `<i class="la la-angle-right"></i>`,
                rightArrow: `<i class="la la-angle-left"></i>`
            }
        } else {
            arrows = {
                leftArrow: `<i class="la la-angle-left"></i>`,
                rightArrow: `<i class="la la-angle-right"></i>`
            }
        }

        // Private functions
        var demos = function () {

            // enable clear button
            $(`#kt_datepicker_3, #kt_datepicker_3_validate`).datepicker({
                rtl: KTUtil.isRTL(),
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                templates: arrows
            });
        }

        return {
    // public functions
    init: function () {
        demos();
    }
};
    }();

    jQuery(document).ready(function () {
        KTBootstrapDatepicker.init();
    });
</script>';
$this->scripts[] = '<script type="application/javascript">
"use strict";

// Class Definition
var KTLogin = function() {
	var _buttonSpinnerClasses = "spinner spinner-right spinner-white pr-15";

	var _handleFormSignup = function() {
		// Base elements
		var wizardEl = KTUtil.getById("kt_login");
		var form = KTUtil.getById("kt_login_signup_form");
		var wizardObj;
		var validations = [];

		if (!form) {
			return;
		}

		const strongPassword = function() {
			return {
				validate: function(input) {
					const value = input.value;
					if (value === "") {
						return {
							valid: true,
						};
					}

					// Check the password strength
					if (value.length < 8) {
						return {
							valid: false,
							message: "The password must be more than 8 characters long",
						};
					}

					// The password does not contain any uppercase character
					if (value === value.toLowerCase()) {
						return {
							valid: false,
							message: "The password must contain at least one upper case character",
						};
					}

					// The password does not contain any lower character
					if (value === value.toUpperCase()) {
						return {
							valid: false,
							message: "The password must contain at least one lower case character",
						};
					}

					// The password does not contain any digit
					if (value.search(/[0-9]/) < 0) {
						return {
							valid: false,
							message: "The password must contain at least one digit",
						};
					}

					return {
						valid: true,
					};
				},
			};
		};

		const uniqueEmail = function() {
			return {
				validate: async function (input) {
					const value = input.value;
					if (!value) return {
						valid: true
					};

					return {
						valid: await FormValidation.utils.fetch("/api/isnewemail", {
							method: "POST",
							dataType: "json",
							params: {
								email: value
							},
						}).then(function (error) { // Return valid JSON
								return error["canCreate"];
						})
					}
				},
			};
		};

		// Init form validation rules. For more info check the FormValidation plugin"s official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(form, {
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: "Password is required"
                        },
                        strongPassword
                    }
                },
                passwordConfirm: {
                    validators: {
                        notEmpty: {
                            message: "The password confirmation is required"
                                        },
                        identical: {
                            compare: function() {
                                return form.querySelector(`[name="password"]`).value;
                            },
                            message: "The password and its confirm are not the same"
                                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "Email is required"
                        },
                        emailAddress: {
                            message: "The value is not a valid email address"
                        },
                        uniqueEmail: {
                            message: "Email already exist"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                // Bootstrap Framework Integration
                bootstrap: new FormValidation.plugins.Bootstrap({
                    //eleInvalidClass: "",
                    eleValidClass: "",
                })
            }
		}).registerValidator("strongPassword", strongPassword).registerValidator("uniqueEmail", uniqueEmail));

		// Step 2
		validations.push(FormValidation.formValidation(form, {
			fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "Name is required"
                                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "Phone is required"
                                        }
                    }
                },
                dateOfBirth: {
                    validations: {
                        notEmpty: {
                            message: "Date of birth is required"
                                        }
                    }
                }
            },
			plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                // Bootstrap Framework Integration
                bootstrap: new FormValidation.plugins.Bootstrap({
                    //eleInvalidClass: "",
                    eleValidClass: "",
                })
            }
		}));

		// Initialize form wizard
		wizardObj = new KTWizard(wizardEl, {
            startStep: 1, // initial active step number
			clickableSteps: false  // allow step clicking
		});

		// Validation before going to next page
		wizardObj.on("change", function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip if stepped back
            }

            // Validate form before change wizard step
            var validator = validations[wizard.getStep() - 1]; // get validator for currnt step

            if (validator) {
                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        wizard.goTo(wizard.getNewStep());
					}
                    KTUtil.scrollTop();
                });
            }

            return false;  // Do not change wizard step, further action will be handled by he validator
        });

		// Change event
		wizardObj.on("changed", function (wizard) {
            KTUtil.scrollTop();
        });

		// Submit event
		wizardObj.on("submit", function (wizard) {
		    fetch("'.Path::API_GET_CLOUDINARY_SIGNATURE[0].'")
		        .then(response => {
		            response.text().then(text => {
		                text = JSON.parse(text);
		                console.log(text);
		                if (response.status === 200) {
		                    const {signature, timestamp, api_key, url, public_id} = text;
		                    const files = document.querySelector("[type=file]").files;
		                    		                    
                            const formData = new FormData();
                            
                            for (let i = 0; i < files.length; i++) {
                                let file = files[i];
                                formData.append("file", file);
                                formData.append("api_key", api_key);
                                formData.append("timestamp", timestamp);
                                formData.append("public_id", public_id);
                                formData.append("signature", signature);
                                                            
                                fetch(url, {
                                  method: "POST",
                                  body: formData
                                }).then((response) => {
                                    if (response.status === 200) {
                                        response.text().then(text => {
                                            form.imgPath.value = JSON.parse(text).url;
                                            form.submit();
                                        })
                                    }
                                });
                            }
		                }
		            })
		        })
		    
//            form.submit();
		});
    }

    // Public Functions
    return {
        init: function() {
            _handleFormSignup();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
    $(window).keydown(function(event){
    if(event.keyCode === 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>';
$this->scripts[] = '<script type="application/javascript">
"use strict";

// Class definition
var KTImageInputDemo = function () {
	// Private functions
	var initDemos = function () {
		var avatar = new KTImageInput("register_avatar_input");
	}

	return {
		// public functions
		init: function() {
			initDemos();
		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();
});
</script>';
?>
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-15 px-30">
                <!--begin::Aside header-->
                <a href="#" class="login-logo py-6">
                    <img src="assets/media/logos/logo-1.png" class="max-h-70px" alt=""/>
                </a>
                <!--end::Aside header-->
                <!--begin: Wizard Nav-->
                <div class="wizard-nav pt-5 pt-lg-30">
                    <!--begin::Wizard Steps-->
                    <div class="wizard-steps">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    <i class="wizard-check ki ki-check"></i>
                                    <span class="wizard-number">1</span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">Account Settings</h3>
                                    <div class="wizard-desc">Setup Your Account Details</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 1 Nav-->
                        <!--begin::Wizard Step 2 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    <i class="wizard-check ki ki-check"></i>
                                    <span class="wizard-number">2</span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">Personal Details</h3>
                                    <div class="wizard-desc">Some personal information</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 2 Nav-->
                        <!--begin::Wizard Step 4 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    <i class="wizard-check ki ki-check"></i>
                                    <span class="wizard-number">3</span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">Completed!</h3>
                                    <div class="wizard-desc">Review and Submit</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 4 Nav-->
                    </div>
                    <!--end::Wizard Steps-->
                </div>
                <!--end: Wizard Nav-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img-wizard d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center pt-2 pt-lg-5"
                 style="background-position-y: calc(100% + 3rem); background-image: url(assets/media/svg/illustrations/features.svg)"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-column-fluid d-flex flex-column p-10">
            <!--begin::Top-->
            <div class="text-right d-flex justify-content-center">
                <div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                    <a href="javascript:;" class="font-weight-bolder text-primary font-size-h4 ml-2"
                       id="kt_login_signup">Get Help</a>
                </div>
            </div>
            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-form-signup">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_signup_form" action="/register"
                          method="post">
                        <!--begin: Wizard Step 1-->
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Title-->
                            <div class="pb-10 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark display5">Create Account</h3>
                                <div class="text-muted font-weight-bold font-size-h4">Already have an Account ?
                                    <a href="/login" class="text-primary font-weight-bolder">Sign In</a></div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Form Group-->
                            <div class="form-group">
                                <?PHP
                                echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                <input type="email"
                                       class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                       name="{{name}}" placeholder="{{label}}" value="{{value}}"/>',
                                    'email')
                                ?>
                            </div>
                            <!--end::Form Group-->
                            <!--begin::Form Group-->
                            <div class="form-group">
                                <?PHP
                                echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                <input type="password"
                                       class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                       name="{{name}}" placeholder="{{label}}" value="{{value}}"/>', 'password');
                                ?>
                            </div>
                            <!--end::Form Group-->
                            <!--begin::Form Group-->
                            <div class="form-group">
                                <?PHP
                                echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                <input type="password"
                                       class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                       name="{{name}}" placeholder="{{label}}" value="{{value}}"/>', 'passwordConfirm')
                                ?>
                            </div>
                            <!--end::Form Group-->
                        </div>
                        <!--end: Wizard Step 1-->
                        <!--begin: Wizard Step 2-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <!--begin::Title-->
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Personal
                                    Details</h3>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-8">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <?PHP
                                        echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                        <input type="text"
                                               class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                               name="{{name}}" placeholder="{{label}}" value="{{value}}"/>', 'name');
                                        ?>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <div class="col-xl-4">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <?PHP
                                        echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                        <input type="text"
                                               class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                               name="{{name}}" placeholder="{{label}}" value="{{value}}"/>', 'phone');
                                        ?>
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-6">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <?PHP
                                        echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                        <div class="form-group row h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                            <div class="col-9 col-form-label">
                                                <div class="radio-inline">
                                                    <label class="radio radio-success">
                                                        <input type="radio" name="{{name}}" checked="checked" value="Male"/>
                                                        <span></span>
                                                        Male
                                                    </label>
                                                    <label class="radio radio-danger">
                                                        <input type="radio" name="{{name}}" value="Female"/>
                                                        <span></span>
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>', 'gender');
                                        ?>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <div class="col-xl-6">
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <?PHP
                                        echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                        <div class="form-group row">
                                            <div class="col">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" readonly value="07/27/1999"
                                                           id="kt_datepicker_3" name="{{name}}"/>
                                                    <div class="input-group-append">
       <span class="input-group-text">
        <i class="la la-calendar"></i>
       </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>', 'dateOfBirth')
                                        ?>
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end: Wizard Step 2-->
                        <!--begin: Wizard Step 4-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <!--begin::Title-->
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Complete</h3>
                                <div class="text-muted font-weight-bold font-size-h4">Complete Your Signup And Become A
                                    Member!
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Add a profile avatar:</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline" id="register_avatar_input">
                                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_1.jpg)"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <?PHP
                                echo new Field($model, '<label class="font-size-h6 font-weight-bolder text-dark">{{label}}</label>
                                <input type="text"
                                       class="form-contro"
                                       name="{{name}}" placeholder="{{label}}" value="{{value}}"/>', 'imgPath')
                                ?>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end: Wizard Step 4-->
                        <!--begin: Wizard Actions-->
                        <div class="d-flex justify-content-between pt-3">
                            <div class="mr-2">
                                <button type="button"
                                        class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3"
                                        data-wizard-type="action-prev">
										<span class="svg-icon svg-icon-md mr-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<rect fill="#000000" opacity="0.3"
                                                          transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)"
                                                          x="14" y="7" width="2" height="10" rx="1"/>
													<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                                          fill="#000000" fill-rule="nonzero"
                                                          transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)"/>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>Previous
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3"
                                        data-wizard-type="action-submit" type="submit"
                                        id="kt_login_signup_form_submit_button">Submit
                                    <span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<rect fill="#000000" opacity="0.3"
                                                          transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                          x="7.5" y="7.5" width="2" height="9" rx="1"/>
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                          fill="#000000" fill-rule="nonzero"
                                                          transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"/>
												</g>
											</svg>
                                        <!--end::Svg Icon-->
										</span></button>
                                <button type="button"
                                        class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3"
                                        data-wizard-type="action-next">Next Step
                                    <span class="svg-icon svg-icon-md ml-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<rect fill="#000000" opacity="0.3"
                                                          transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                          x="7.5" y="7.5" width="2" height="9" rx="1"/>
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                          fill="#000000" fill-rule="nonzero"
                                                          transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"/>
												</g>
											</svg>
                                        <!--end::Svg Icon-->
										</span></button>
                            </div>
                        </div>
                        <!--end: Wizard Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>