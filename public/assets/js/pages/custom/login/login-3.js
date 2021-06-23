"use strict";

// Class Definition
var KTLogin = function() {
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

	var _handleFormSignin = function() {
		var form = KTUtil.getById('kt_login_singin_form');
		var formSubmitUrl = KTUtil.attr(form, 'action');
		var formSubmitButton = KTUtil.getById('kt_login_singin_form_submit_button');

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
									message: 'Email is required'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'Password is required'
								}
							}
						}
		            },
		            plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
						//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
						//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
		            }
		        }
		    )
		    .on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");

				// Simulate Ajax request
				// setTimeout(function() {
				// 	KTUtil.btnRelease(formSubmitButton);
				// }, 2000);

				fetch(formSubmitUrl, {
					method: 'POST',
					headers: {
						'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
					},
					body: JSON.stringify({
						email: form.querySelector('[name="email"]').value,
						password: form.querySelector('[name="password"]').value,
					})
				}).then(async response => {
					KTUtil.btnRelease(formSubmitButton);

					console.log(await response.text())
				});

				// Form Validation & Ajax Submission: https://formvalidation.io/guide/examples/using-ajax-to-submit-the-form
		        FormValidation.utils.fetch(formSubmitUrl, {
		            method: 'POST',
					dataType: 'json',
		            params: {
		                password: form.querySelector('[name="password"]').value,
		                email: form.querySelector('[name="email"]').value,
		            },
		        }).then(function(error) { // Return valid JSON
					// Release button
					KTUtil.btnRelease(formSubmitButton);


					if (!error) {
						document.location.href = '/';
					} else {
						Swal.fire({
			                text: `Sorry, ${error.email ? error.email[0] : error.password ? error.password[0] : `Something wrong, check the form again.`}`,
			                icon: "error",
			                buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
			            }).then(function() {
							KTUtil.scrollTop();
						});
					}
		        });
		    })
			.on('core.form.invalid', function() {
				KTUtil.scrollTop();
		    });
    }

	var _handleFormForgot = function() {
		var form = KTUtil.getById('kt_login_forgot_form');
		var formSubmitUrl = KTUtil.attr(form, 'action');
		var formSubmitButton = KTUtil.getById('kt_login_forgot_form_submit_button');

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
									message: 'Email is required'
								},
								emailAddress: {
									message: 'The value is not a valid email address'
								}
							}
						}
		            },
		            plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
						//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
						//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
		            }
		        }
		    )
		    .on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");

				// Simulate Ajax request
				setTimeout(function() {
					KTUtil.btnRelease(formSubmitButton);
				}, 2000);
		    })
			.on('core.form.invalid', function() {
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

	var _handleFormSignup = function() {
		// Base elements
		var wizardEl = KTUtil.getById('kt_login');
		var form = KTUtil.getById('kt_login_signup_form');
		var wizardObj;
		var validations = [];

		if (!form) {
			return;
		}

		const strongPassword = function() {
			return {
				validate: function(input) {
					const value = input.value;
					if (value === '') {
						return {
							valid: true,
						};
					}

					// Check the password strength
					if (value.length < 8) {
						return {
							valid: false,
							message: 'The password must be more than 8 characters long',
						};
					}

					// The password does not contain any uppercase character
					if (value === value.toLowerCase()) {
						return {
							valid: false,
							message: 'The password must contain at least one upper case character',
						};
					}

					// The password does not contain any lower character
					if (value === value.toUpperCase()) {
						return {
							valid: false,
							message: 'The password must contain at least one lower case character',
						};
					}

					// The password does not contain any digit
					if (value.search(/[0-9]/) < 0) {
						return {
							valid: false,
							message: 'The password must contain at least one digit',
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
						valid: await FormValidation.utils.fetch('/isnewemail', {
							method: 'POST',
							dataType: 'json',
							params: {
								email: value
							},
						}).then(function (error) { // Return valid JSON
								return error['canCreate'];
						})
					}
				},
			};
		};

		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							},
							strongPassword
						}
					},
					passwordConfirm: {
						validators: {
							notEmpty: {
								message: 'The password confirmation is required'
							},
							identical: {
								compare: function() {
									return form.querySelector('[name="password"]').value;
								},
								message: 'The password and its confirm are not the same'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							},
							uniqueEmail: {
								message: 'Email already exist'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		).registerValidator('strongPassword', strongPassword)
			.registerValidator('uniqueEmail', uniqueEmail));

		// Step 2
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Name is required'
							}
						}
					},
					phone: {
						validators: {
							notEmpty: {
								message: 'Phone is required'
							}
						}
					},
					dateOfBirth: {
						validations: {
							notEmpty: {
								message: 'Date of birth is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Initialize form wizard
		wizardObj = new KTWizard(wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false  // allow step clicking
		});

		// Validation before going to next page
		wizardObj.on('change', function (wizard) {
			if (wizard.getStep() > wizard.getNewStep()) {
				return; // Skip if stepped back
			}

			// Validate form before change wizard step
			var validator = validations[wizard.getStep() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						wizard.goTo(wizard.getNewStep());
					}
					KTUtil.scrollTop();
				});
			}

			return false;  // Do not change wizard step, further action will be handled by he validator
		});

		// Change event
		wizardObj.on('changed', function (wizard) {
			KTUtil.scrollTop();
		});

		// Submit event
		wizardObj.on('submit', function (wizard) {
			// Swal.fire({
			// 	text: "All is good! Please confirm the form submission.",
			// 	icon: "success",
			// 	showCancelButton: true,
			// 	buttonsStyling: false,
			// 	confirmButtonText: "Yes, submit!",
			// 	cancelButtonText: "No, cancel",
			// 	customClass: {
			// 		confirmButton: "btn font-weight-bold btn-primary",
			// 		cancelButton: "btn font-weight-bold btn-default"
			// 	}
			// }).then(function (result) {
			// 	if (result.value) {
			// 		form.submit(); // Submit form
			// 	} else if (result.dismiss === 'cancel') {
			// 		Swal.fire({
			// 			text: "Your form has not been submitted!.",
			// 			icon: "error",
			// 			buttonsStyling: false,
			// 			confirmButtonText: "Ok, got it!",
			// 			customClass: {
			// 				confirmButton: "btn font-weight-bold btn-primary",
			// 			}
			// 		});
			// 	}
			// });

			const body = {
				email: form.querySelector('[name="email"]').value,
				password: form.querySelector('[name="password"]').value,
				passwordConfirm: form.querySelector('[name="passwordConfirm"]').value,
				name: form.querySelector('[name="name"]').value,
				phone: form.querySelector('[name="phone"]').value,
				gender: form.querySelector('[name="gender"]').value,
				dateOfBirth: form.querySelector('[name="dateOfBirth"]').value
			}

			FormValidation.utils.fetch(form.getAttribute('action'), {
				dataType: 'json',
				method: form.getAttribute('method'),
				params: body,
			}).then(function(error) { // Return valid JSON
				if (!error) {
					document.location.href = '/login';
				} else {
					Swal.fire({
						text: `Something wrong, check the form again.`,
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					}).then(function() {
						KTUtil.scrollTop();
					});
				}
			});
		});
    }

    // Public Functions
    return {
        init: function() {
            _handleFormSignin();
			_handleFormForgot();
			_handleFormSignup();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
