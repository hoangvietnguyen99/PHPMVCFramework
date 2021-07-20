<?PHP
/** @var $this View */
/** @var $model AskForm */
/** @var $categories Category[] */

use app\core\Application;
use app\core\form\Field;
use app\core\View;
use app\models\AskForm;
use app\models\Category;

$this->title = 'Ask';
$user = Application::$application->user;

$this->scripts[] = '<script src="assets/js/pages/crud/forms/editors/summernote.js"></script>';
$this->scripts[] = '<script type="application/javascript">
"use strict";

// Class Definition
var KTAsk = function() {
	var _handleFormAsk = function() {
		var form = KTUtil.getById("ask-form");

		if (!form) {
			return;
		}

		FormValidation
		    .formValidation(
		        form,
		        {
		            fields: {
						title: {
							validators: {
								notEmpty: {
									message: "Title is required"
								}
							}
						},
						category: {
							validators: {
								notEmpty: {
									message: "Category is required"
								}
							}
						},
						description: {
							validators: {
								notEmpty: {
									message: "Description is required"
								}
							}
						},
						tags: {
							validators: {
								notEmpty: {
									message: "Tags is required"
								}
							}
						},
		            },
		            plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
						bootstrap: new FormValidation.plugins.Bootstrap({
						})
		            }
		        }
		    )
			.on("core.form.invalid", function() {
				KTUtil.scrollTop();
		    });
    }

    // Public Functions
    return {
        init: function() {
            _handleFormAsk();
        }
    };
}();

var KTTagify = function() {
    // Private functions
    var demo1 = function() {
        fetch("/api/tags")
            .then(response => {
                response.text().then(text => {
                    text = JSON.parse(text);
                    var input = document.getElementById("kt_tagify_1"),
                        // init Tagify script on the above inputs
                        tagify = new Tagify(input, {
                            whitelist: text.map(item => item.name),
                        })


                    // "remove all tags" button event listener
                    document.getElementById("kt_tagify_1_remove").addEventListener("click", tagify.removeAllTags.bind(tagify));

                    // Chainable event listeners
                    tagify.on("add", onAddTag)
//                        .on("remove", onRemoveTag)
//                        .on("input", onInput)
//                        .on("edit", onTagEdit)
//                        .on("invalid", onInvalidTag)
//                        .on("click", onTagClick)
//                        .on("dropdown:show", onDropdownShow)
//                        .on("dropdown:hide", onDropdownHide)
//
                    // tag added callback
                    function onAddTag(e) {
                        console.log("onAddTag: ", e.detail);
                        console.log("original input value: ", input.value)
                        tagify.off("add", onAddTag) // exmaple of removing a custom Tagify event
                    }

//                    // tag remvoed callback
//                    function onRemoveTag(e) {
//                        console.log(e.detail);
//                        console.log("tagify instance value:", tagify.value)
//                    }
//
//                    // on character(s) added/removed (user is typing/deleting)
//                    function onInput(e) {
//                        console.log(e.detail);
//                        console.log("onInput: ", e.detail);
//                    }
//
//                    function onTagEdit(e) {
//                        console.log("onTagEdit: ", e.detail);
//                    }
//
//                    // invalid tag added callback
//                    function onInvalidTag(e) {
//                        console.log("onInvalidTag: ", e.detail);
//                    }
//
//                    // invalid tag added callback
//                    function onTagClick(e) {
//                        console.log(e.detail);
//                        console.log("onTagClick: ", e.detail);
//                    }
//
//                    function onDropdownShow(e) {
//                        console.log("onDropdownShow: ", e.detail)
//                    }
//
//                    function onDropdownHide(e) {
//                        console.log("onDropdownHide: ", e.detail)
//                    }
                });
            });
    }


    return {
    // public functions
    init: function() {
        demo1();
    }
};
}();
// Class Initialization
jQuery(document).ready(function() {
    KTAsk.init();
    KTTagify.init();
});

</script>';
?>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Content-->
            <div class="flex-row-fluid mr-lg-8">
                <div class="row">
                    <div class="col-xxl-12">
                        <!--begin::Forms Widget 2-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Top-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40 symbol-light-success mr-5">
																<span class="symbol-label">
																	<img src="<?php echo $user->imgPath ?>"
                                                                         class="h-75 align-self-end" alt=""/>
																</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Description-->
                                    <span class="text-muted font-weight-bold font-size-lg">What’s on your mind?</span>
                                    <!--end::Description-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Form-->
                                <form id="ask-form" class="form" action="/ask" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <?php echo new Field(
                                                    $model,
                                                    '<label>{{label}}</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                           placeholder="{{label}}" name="{{name}}" value="{{value}}" autofocus/>',
                                                    'title'
                                                ) ?>
                                            </div>
                                            <div class="form-group col-6">
                                                <?php echo new Field(
                                                    $model,
                                                    '<label for="exampleSelect1">{{label}}</label>
                                                    <select class="form-control" id="ask-form-category" name="{{name}}">'.(implode('', array_map(fn($cat) => '<option>'.($cat->name).'</option>', $categories))).'</select>',
                                                    'category'
                                                ) ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo new Field(
                                                $model,
                                                '<label>{{label}}</label>
                                                <textarea name="{{name}}" class="summernote" id="kt_summernote_1">{{value}}</textarea>',
                                                'description'
                                            ) ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo new Field(
                                                $model,
                                                '<label>Add some tags</label>
                                                <div>
                                                    <input id="kt_tagify_1" class="form-control tagify" name="{{name}}"
                                                           placeholder="tags..." value="{{value}}"
                                                           />
                                                    <div class="mt-3">
                                                        <a href="javascript:;" id="kt_tagify_1_remove"
                                                           class="btn btn-sm btn-light-primary font-weight-bold">Remove
                                                            tags</a>
                                                    </div>
                                                </div>',
                                                'tags'
                                            ) ?>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" id="ask-form-submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Forms Widget 2-->
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
