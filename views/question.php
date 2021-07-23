<?php

use app\core\exception\NotFoundException;
use app\core\form\Field;
use app\core\View;
use app\models\Question;
use app\models\AnswerForm;
use app\models\User;
use app\utils\DateTimeUtil;

/** @var $question Question */
/** @var $this View */
/** @var $author User */
/** @var $model AnswerForm */

$author = User::findOne(['_id' => $question->author]);
if (!$author) throw new NotFoundException();

$this->scripts[] = '<script src="assets/js/pages/crud/forms/editors/summernote.js"></script>';
$this->scripts[] = '<script type="application/javascript">
"use strict";

var KTCardTools = function () {
    // Toastr
//    var initToastr = function() {
//        toastr.options.showDuration = 1000;
//    }

    // Reply card
    var replyCard = function() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard("reply_card");

    // Toggle event handlers
    card.on("beforeCollapse", function(card) {
//        setTimeout(function() {
//            toastr.info("Before collapse event fired!");
//        }, 100);
    });

    card.on("afterCollapse", function(card) {
////        setTimeout(function() {
////            toastr.warning("Before collapse event fired!");
////        }, 2000);
    });

    card.on("beforeExpand", function(card) {
////        setTimeout(function() {
////            toastr.info("Before expand event fired!");
////        }, 100);
    });

    card.on("afterExpand", function(card) {
//        setTimeout(function() {
//            toastr.warning("After expand event fired!");
//        }, 2000);
    });

    // Remove event handlers
    card.on("beforeRemove", function(card) {
//        toastr.info("Before remove event fired!");
//
//        return confirm("Are you sure to remove this card ?");  // remove card after user confirmation
    });

    card.on("afterRemove", function(card) {
//        setTimeout(function() {
//            toastr.warning("After remove event fired!");
//        }, 2000);
    });

    // Reload event handlers
    card.on("reload", function(card) {
//        toastr.info("Leload event fired!");
//
//        KTApp.block(card.getSelf(), {
//                type: "loader",
//                state: "primary",
//                message: "Please wait..."
//            });
//
//            // update the content here
//
//            setTimeout(function() {
//                KTApp.unblock(card.getSelf());
//            }, 2000);
        });
}

// Reply card
    var answersCard = function() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard("answers_card");

    // Toggle event handlers
    card.on("beforeCollapse", function(card) {
//        setTimeout(function() {
//            toastr.info("Before collapse event fired!");
//        }, 100);
    });

    card.on("afterCollapse", function(card) {
////        setTimeout(function() {
////            toastr.warning("Before collapse event fired!");
////        }, 2000);
    });

    card.on("beforeExpand", function(card) {
////        setTimeout(function() {
////            toastr.info("Before expand event fired!");
////        }, 100);
    });

    card.on("afterExpand", function(card) {
//        setTimeout(function() {
//            toastr.warning("After expand event fired!");
//        }, 2000);
    });

    // Remove event handlers
    card.on("beforeRemove", function(card) {
//        toastr.info("Before remove event fired!");
//
//        return confirm("Are you sure to remove this card ?");  // remove card after user confirmation
    });

    card.on("afterRemove", function(card) {
//        setTimeout(function() {
//            toastr.warning("After remove event fired!");
//        }, 2000);
    });

    // Reload event handlers
    card.on("reload", function(card) {
        toastr.info("Leload event fired!");

        KTApp.block(card.getSelf(), {
                type: "loader",
                state: "primary",
                message: "Please wait..."
            });

            
             var myHeaders = new Headers();
             myHeaders.append("Content-Type", "application/json");
				
             var requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: JSON.stringify(body)
             };
				
            fetch("/api/answers?question_id=60d6e4997db50905dc7034fb", requestOptions)
            .then(response => response.text())
            .then(text => {
                console.log(text);
            });

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });
}

    return {
    //main function to initiate the module
    init: function () {
//        initToastr();
        replyCard();
        answersCard()
    }
};
}();

var KTReply = function() {
	var _handleFormReply = function() {
		var form = KTUtil.getById("reply-form");

		if (!form) {
			return;
		}

		FormValidation
		    .formValidation(
		        form,
		        {
		            fields: {
						reply: {
							validators: {
								notEmpty: {
									message: "Reply is required"
								}
							}
						}
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

		    });
    }

    // Public Functions
    return {
        init: function() {
            _handleFormReply();
        }
    };
}();

jQuery(document).ready(function() {
    KTCardTools.init();
    KTReply.init();
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
                                <!--begin::Container-->
                                <div>
                                    <?php foreach ($question->category as $category) {
                                        echo '<a href="' . "/questions?category={$category->_id->__toString()}" . '" class="btn btn-light-primary font-weight-bold mr-2 mb-2">' . $category->name . '</a>';
                                    } ?>
                                    <!--begin::Header-->
                                    <div class="d-flex align-items-center pb-4">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $question->title ?></a>
                                            <span class="text-muted font-weight-bold"><?php echo DateTimeUtil::getDiffForHumans($question->createdDate) ?></span>
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Dropdown-->
                                        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <span class="font-size-lg">Choose Label:</span>
                                                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="navi-separator mb-3 opacity-70"></li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-success">Customer</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-danger">Partner</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-primary">Member</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-dark">Staff</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-separator mt-3 opacity-70"></li>
                                                    <li class="navi-footer py-4">
                                                        <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                            <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                    </li>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                        <!--end::Dropdown-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div>
                                        <?php foreach ($question->tags as $tag) {
                                            echo '<a href="' . "/questions?tag={$tag->_id->__toString()}" . '" class="btn btn-text-success btn-hover-light-success font-weight-bold mr-2 mb-2">#' . $tag->name . '</a>';
                                        } ?>
                                        <!--begin::Text-->
                                        <?php echo htmlspecialchars_decode($question->content) ?>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-primary bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-md pr-2">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-up.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M8.2928955,10.2071068 C7.90237121,9.81658249 7.90237121,9.18341751 8.2928955,8.79289322 C8.6834198,8.40236893 9.31658478,8.40236893 9.70710907,8.79289322 L15.7071091,14.7928932 C16.085688,15.1714722 16.0989336,15.7810586 15.7371564,16.1757246 L10.2371564,22.1757246 C9.86396402,22.5828436 9.23139665,22.6103465 8.82427766,22.2371541 C8.41715867,21.8639617 8.38965574,21.2313944 8.76284815,20.8242754 L13.6158645,15.5300757 L8.2928955,10.2071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.500003) scale(-1, 1) rotate(-90.000000) translate(-12.000003, -15.500003) " />
                                                            <path d="M6.70710678,12.2071104 C6.31658249,12.5976347 5.68341751,12.5976347 5.29289322,12.2071104 C4.90236893,11.8165861 4.90236893,11.1834211 5.29289322,10.7928968 L11.2928932,4.79289682 C11.6714722,4.41431789 12.2810586,4.40107226 12.6757246,4.76284946 L18.6757246,10.2628495 C19.0828436,10.6360419 19.1103465,11.2686092 18.7371541,11.6757282 C18.3639617,12.0828472 17.7313944,12.1103502 17.3242754,11.7371577 L12.0300757,6.88414142 L6.70710678,12.2071104 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 8.500003) scale(-1, 1) rotate(-360.000000) translate(-12.000003, -8.500003) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><?php echo $question->totalLikes ?></a>
                                            <a href="#" class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-danger bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-danger svg-icon-md pr-2">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) " />
                                                            <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><?php echo $question->totalDislikes ?></a>
                                            <a href="#" class="btn btn-hover-text-success btn-hover-icon-success btn-sm btn-text-success bg-hover-light-success rounded font-weight-bolder font-size-sm p-2">
                                                <span class="svg-icon svg-icon-success svg-icon-md pr-2">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\General\Visible.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><?php echo $question->totalViews ?></a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Forms Widget 2-->
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b <?php if (count($question->answers) === 0) : ?>card-collapsed<?php endif; ?>" data-card="true" id="answers_card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Answers: <?php echo count($question->answers) ?></h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                        <i class="ki ki-arrow-down icon-nm"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-success mr-1" data-card-tool="reload">
                                        <i class="ki ki-reload icon-nm"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-danger" data-card-tool="remove">
                                        <i class="ki ki-close icon-nm"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                foreach ($question->answers as $answer) {
                                    /** @var User $answerAuthor */
                                    $answerAuthor = User::findOne(['_id' => $answer->author]);
                                    echo '<div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Container-->
                                <div>
                                <!--begin::Header-->
                                <div class="d-flex align-items-center pb-4">
                                <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5 mt-1">
																<span class="symbol-label">
																	<img src="' . $answerAuthor->imgPath . '" class="h-75 align-self-end" alt="">
																</span>
                                        </div>
                                        <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">' . $answerAuthor->name . '</a>
                                        <span class="text-muted font-weight-bold">' . DateTimeUtil::getDiffForHumans($answer->createdDate) . '</span>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Dropdown-->
                                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header font-weight-bold py-4">
                                                    <span class="font-size-lg">Choose Label:</span>
                                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
																			<span class="navi-text">
																				<span class="label label-xl label-inline label-light-success">Customer</span>
																			</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
																			<span class="navi-text">
																				<span class="label label-xl label-inline label-light-danger">Partner</span>
																			</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
																			<span class="navi-text">
																				<span class="label label-xl label-inline label-light-warning">Suplier</span>
																			</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
																			<span class="navi-text">
																				<span class="label label-xl label-inline label-light-primary">Member</span>
																			</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
																			<span class="navi-text">
																				<span class="label label-xl label-inline label-light-dark">Staff</span>
																			</span>
                                                    </a>
                                                </li>
                                                <li class="navi-separator mt-3 opacity-70"></li>
                                                <li class="navi-footer py-4">
                                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div>
                                    <!--begin::Text-->
                                    ' . htmlspecialchars_decode($answer->content) . '
                                    <!--end::Text-->
                                    <!--begin::Action-->
                                    <div class="d-flex align-items-center">
                                        <a href="#"
                                               class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-primary bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-md pr-2"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-up.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M8.2928955,10.2071068 C7.90237121,9.81658249 7.90237121,9.18341751 8.2928955,8.79289322 C8.6834198,8.40236893 9.31658478,8.40236893 9.70710907,8.79289322 L15.7071091,14.7928932 C16.085688,15.1714722 16.0989336,15.7810586 15.7371564,16.1757246 L10.2371564,22.1757246 C9.86396402,22.5828436 9.23139665,22.6103465 8.82427766,22.2371541 C8.41715867,21.8639617 8.38965574,21.2313944 8.76284815,20.8242754 L13.6158645,15.5300757 L8.2928955,10.2071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.500003) scale(-1, 1) rotate(-90.000000) translate(-12.000003, -15.500003) "/>
        <path d="M6.70710678,12.2071104 C6.31658249,12.5976347 5.68341751,12.5976347 5.29289322,12.2071104 C4.90236893,11.8165861 4.90236893,11.1834211 5.29289322,10.7928968 L11.2928932,4.79289682 C11.6714722,4.41431789 12.2810586,4.40107226 12.6757246,4.76284946 L18.6757246,10.2628495 C19.0828436,10.6360419 19.1103465,11.2686092 18.7371541,11.6757282 C18.3639617,12.0828472 17.7313944,12.1103502 17.3242754,11.7371577 L12.0300757,6.88414142 L6.70710678,12.2071104 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 8.500003) scale(-1, 1) rotate(-360.000000) translate(-12.000003, -8.500003) "/>
    </g>
</svg><!--end::Svg Icon--></span>' . $answer->totalLikes . '</a>
                                            <a href="#"
                                               class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-danger bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-danger svg-icon-md pr-2"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>
        <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>
    </g>
</svg><!--end::Svg Icon--></span>' . $answer->totalDislikes . '</a>
                                    </div>
                                    <!--end::Action-->';
                                    foreach ($answer->replies as $reply) {
                                        /** @var User $replyAuthor */
                                        $replyAuthor = User::findOne(['_id' => $reply->author]);
                                        echo '<!--begin::Item-->
                                    <div class="d-flex py-5">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5 mt-1">
																<span class="symbol-label">
																	<img src="' . $replyAuthor->imgPath . '" class="h-75 align-self-end" alt="">
																</span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap">
                                                <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder pr-6">' . $replyAuthor->name . '</a>
                                                <span class="text-muted font-weight-normal flex-grow-1 font-size-sm">' . DateTimeUtil::getDiffForHumans($reply->createdDate) . '</span>
                                            </div>
                                            <span class="text-dark-75 font-size-sm font-weight-normal pt-1">' . $reply->content . '</span>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->';
                                    }
                                    echo '</div>
                                <!--end::Body-->
                            </div>
                            <!--end::Container-->
                            <!--begin::Separator-->
                            <div class="separator separator-solid mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Editor-->
                            <form class="position-relative" id="reply_answer_form">
                                <textarea class="form-control border-0 p-0 pr-10 resize-none" rows="1" placeholder="Reply..." style="overflow: hidden; word-wrap: break-word; height: 19px;"></textarea>
                                <div class="position-absolute top-0 right-0 mt-n1 mr-n2">
														<span id="submit_reply_answer_form" class="btn btn-icon btn-sm btn-hover-icon-primary">
															<i class="fa fa-comment-alt text-success mr-5"></i>
														</span>
                                </div>
                            </form>
                            <!--edit::Editor-->
                        </div>
                        <!--end::Body-->
                    </div>';
                                } ?>
                            </div>
                        </div>
                        <!--end::Card-->
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b card-collapsed" data-card="true" id="reply_card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Reply</h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                        <i class="ki ki-arrow-down icon-nm"></i>
                                    </a>
                                </div>
                            </div>
                            <form id="reply-form" class="form" action="/reply" method="post">
                                <div class="card-body">
                                    <div class="form-group" hidden>
                                        <?php echo new Field(
                                            $model,
                                            '<label for="question_id_input">{{label}}</label>
                                        <input id="question_id_input" type="text" name="{{name}}"
                                               value="{{value}}">',
                                            'questionId'
                                        ) ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo new Field(
                                            $model,
                                            '<label hidden for="reply_input">{{label}}</label>
                                        <textarea name="{{name}}" class="summernote" id="reply_input">{{value}}</textarea>',
                                            'reply'
                                        ) ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="reply-form-submit" class="btn btn-primary mr-2">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
            <!--end::Content-->
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                <!--begin::Nav Panel Widget 2-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column pt-4 h-100">
                            <!--begin::Container-->
                            <div class="pb-5">
                                <!--begin::Header-->
                                <div class="d-flex flex-column flex-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-120 symbol-circle symbol-success overflow-hidden">
                                        <span class="symbol-label">
                                            <img src="<?php echo $author->imgPath ?>" class="h-75 align-self-end" alt="" />
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Username-->
                                    <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?php echo $author->name ?></a>
                                    <!--end::Username-->
                                    <!--begin::Info-->
                                    <div class="font-weight-bold text-dark-50 font-size-sm pb-6 text-center">
                                        Join <?php echo DateTimeUtil::getDiffForHumans($author->joinDate) ?>
                                        <br>
                                        Tier: <?php echo $author->tier ?>
                                        <br>
                                        Score: <?php echo $author->score ?>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="pt-1">
                                    <!--begin::Text-->
                                    <p class="text-dark-75 font-weight-nirmal font-size-lg m-0 pb-7">Outlines keep
                                        you honest. If poorly thought-out metaphors driving or create keep
                                        structure</p>
                                    <!--end::Text-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Ricky
                                                Hunt</a>
                                            <span class="text-muted font-weight-bold">PHP, SQLite, Artisan CLI</span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">2.8</span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Modules</a>
                                            <span class="text-muted font-weight-bold">Successful Fellas</span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">7</span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center pb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Progress</a>
                                            <span class="text-muted font-weight-bold">Successful Fellas</span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-info label-inline py-5 min-w-45px">+23</span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--eng::Container-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
                                <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Write a Message
                                </button>
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Nav Panel Widget 2-->
                <!--begin::List Widget 17-->
                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Books to Pickup</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">24 Books to Return</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover py-5">
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-drop"></i>
                                                </span>
                                                <span class="navi-text">New Group</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-list-3"></i>
                                                </span>
                                                <span class="navi-text">Contacts</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-rocket-1"></i>
                                                </span>
                                                <span class="navi-text">Groups</span>
                                                <span class="navi-link-badge">
                                                    <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-bell-2"></i>
                                                </span>
                                                <span class="navi-text">Calls</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-gear"></i>
                                                </span>
                                                <span class="navi-text">Settings</span>
                                            </a>
                                        </li>
                                        <li class="navi-separator my-3"></li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-magnifier-tool"></i>
                                                </span>
                                                <span class="navi-text">Help</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-bell-2"></i>
                                                </span>
                                                <span class="navi-text">Privacy</span>
                                                <span class="navi-link-badge">
                                                    <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Container-->
                        <div>
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Symbol-->
                                <div class="symbol mr-5 pt-1">
                                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/4.png')"></div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Darius
                                        The Great</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                                        <br />Darius greatness</span>
                                    <!--end::Text-->
                                    <!--begin::Action-->
                                    <div>
                                        <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
                                        </button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Symbol-->
                                <div class="symbol mr-5 pt-1">
                                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/12.png')"></div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Wild
                                        Blues</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                                        <br />Darius greatness</span>
                                    <!--end::Text-->
                                    <!--begin::Action-->
                                    <div>
                                        <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
                                        </button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol mr-5 pt-1">
                                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/13.png')"></div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Simple
                                        Thinking</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                                        <br />Darius greatness</span>
                                    <!--end::Text-->
                                    <!--begin::Action-->
                                    <div>
                                        <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
                                        </button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 17-->
                <!--begin::List Widget 9-->
                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0 mt-4">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="font-weight-bolder text-dark">My Activity</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover">
                                        <li class="navi-header font-weight-bold py-4">
                                            <span class="font-size-lg">Choose Label:</span>
                                            <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="navi-separator mb-3 opacity-70"></li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-success">Customer</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-danger">Partner</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-primary">Member</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-dark">Staff</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-separator mt-3 opacity-70"></li>
                                        <li class="navi-footer py-4">
                                            <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Timeline-->
                        <div class="timeline timeline-6 mt-3">
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-warning icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Text-->
                                <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                    Outlines keep you honest. And keep structure
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">10:00</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-success icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Content-->
                                <div class="timeline-content d-flex">
                                    <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">AEOL meeting</span>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">14:37</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Desc-->
                                <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Make
                                    deposit
                                    <a href="#" class="text-primary">USD 700</a>. to ESL
                                </div>
                                <!--end::Desc-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">16:50</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-primary icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Text-->
                                <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">
                                    Indulging in poorly driving and keep structure keep great
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">21:03</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Desc-->
                                <div class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">New
                                    order placed
                                    <a href="#" class="text-primary">#XF-2356</a>.
                                </div>
                                <!--end::Desc-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="timeline-item align-items-start">
                                <!--begin::Label-->
                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">23:07</div>
                                <!--end::Label-->
                                <!--begin::Badge-->
                                <div class="timeline-badge">
                                    <i class="fa fa-genderless text-info icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Text-->
                                <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">
                                    Outlines keep and you honest. Indulging in poorly driving
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->