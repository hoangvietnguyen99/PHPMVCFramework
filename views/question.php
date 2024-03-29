<?php

use app\constants\Path;
use app\core\exception\NotFoundException;
use app\core\form\Field;
use app\core\View;
use app\models\Question;
use app\models\AnswerForm;
use app\models\User;
use app\core\Application;
use app\utils\DateTimeUtil;

/** @var $question Question */
/** @var $this View */
/** @var $model AnswerForm */

$this->title = Path::QUESTIONS[1];
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
                                    <?php foreach ($question->categories as $category) {
                                        echo '<a href="' . "/questions?category={$category->getId()->__toString()}" . '" class="btn btn-light-primary font-weight-bold mr-2 mb-2">' . $category->name . '</a>';
                                    } ?>
                                    <!--begin::Header-->
                                    <div class="d-flex align-items-center pb-4">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"><?php echo $question->title ?></a>
                                            <span class="text-muted font-weight-bold"><?php echo DateTimeUtil::getDiffForHumans($question->publishDate) ?></span>
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
                                        Tags:
                                        <?php foreach ($question->tags as $tag) {
                                            echo '<a href="' . "/questions?tag={$tag->getId()->__toString()}" . '" class="btn btn-text-success btn-hover-light-success font-weight-bold mr-2 mb-2">#' . $tag->name . '</a>';
                                        } ?>
                                        <!--begin::Text-->
                                        <?php echo htmlspecialchars_decode($question->content) ?>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div class="d-flex align-items-center">
                                            <a href="#" <?php if (Application::$application->user && array_search((Application::$application->user)->getId(), $question->likedUserIds) !== false) echo 'style="background-color: #D7F9EF !important;"' ?> id="like-question" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-primary bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-md pr-2">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-up.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M8.2928955,10.2071068 C7.90237121,9.81658249 7.90237121,9.18341751 8.2928955,8.79289322 C8.6834198,8.40236893 9.31658478,8.40236893 9.70710907,8.79289322 L15.7071091,14.7928932 C16.085688,15.1714722 16.0989336,15.7810586 15.7371564,16.1757246 L10.2371564,22.1757246 C9.86396402,22.5828436 9.23139665,22.6103465 8.82427766,22.2371541 C8.41715867,21.8639617 8.38965574,21.2313944 8.76284815,20.8242754 L13.6158645,15.5300757 L8.2928955,10.2071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.500003) scale(-1, 1) rotate(-90.000000) translate(-12.000003, -15.500003) " />
                                                            <path d="M6.70710678,12.2071104 C6.31658249,12.5976347 5.68341751,12.5976347 5.29289322,12.2071104 C4.90236893,11.8165861 4.90236893,11.1834211 5.29289322,10.7928968 L11.2928932,4.79289682 C11.6714722,4.41431789 12.2810586,4.40107226 12.6757246,4.76284946 L18.6757246,10.2628495 C19.0828436,10.6360419 19.1103465,11.2686092 18.7371541,11.6757282 C18.3639617,12.0828472 17.7313944,12.1103502 17.3242754,11.7371577 L12.0300757,6.88414142 L6.70710678,12.2071104 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 8.500003) scale(-1, 1) rotate(-360.000000) translate(-12.000003, -8.500003) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><span class="totalLike-question"><?php echo $question->totalLikes ?></span></a>
                                            <a href="#" <?php if (Application::$application->user && array_search((Application::$application->user)->getId(), $question->dislikedUserIds) !== false) echo 'style="background-color: #FFE2E5 !important;"' ?> id="dislike-question" class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-danger bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-danger svg-icon-md pr-2">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) " />
                                                            <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) " />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><span class="totalDislike-question"><?php echo $question->totalDislikes ?></span></a>
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
                                    <h3 class="card-label">Other's Answers: <?php echo count($question->answers) ?></h3>
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
																	<img src="' . $answer->author->imgPath . '" class="h-100 align-self-end" alt="">
																</span>
                                        </div>
                                        <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">' . $answer->author->name . '</a>
                                        <span class="text-muted font-weight-bold">' . DateTimeUtil::getDiffForHumans($answer->publishDate) . '</span>
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
                                        <a data-idanswer=' . $answer->getId() . ' href="#" ' . (Application::$application->user && array_search((Application::$application->user)->getId(), $answer->likedUserIds) !== false ? ' style="background-color: #D7F9EF !important;" ' : '') . '
                                               class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-primary bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2 like-answer">
                                                <span class="svg-icon svg-icon-primary svg-icon-md pr-2"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-up.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M8.2928955,10.2071068 C7.90237121,9.81658249 7.90237121,9.18341751 8.2928955,8.79289322 C8.6834198,8.40236893 9.31658478,8.40236893 9.70710907,8.79289322 L15.7071091,14.7928932 C16.085688,15.1714722 16.0989336,15.7810586 15.7371564,16.1757246 L10.2371564,22.1757246 C9.86396402,22.5828436 9.23139665,22.6103465 8.82427766,22.2371541 C8.41715867,21.8639617 8.38965574,21.2313944 8.76284815,20.8242754 L13.6158645,15.5300757 L8.2928955,10.2071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.500003) scale(-1, 1) rotate(-90.000000) translate(-12.000003, -15.500003) "/>
        <path d="M6.70710678,12.2071104 C6.31658249,12.5976347 5.68341751,12.5976347 5.29289322,12.2071104 C4.90236893,11.8165861 4.90236893,11.1834211 5.29289322,10.7928968 L11.2928932,4.79289682 C11.6714722,4.41431789 12.2810586,4.40107226 12.6757246,4.76284946 L18.6757246,10.2628495 C19.0828436,10.6360419 19.1103465,11.2686092 18.7371541,11.6757282 C18.3639617,12.0828472 17.7313944,12.1103502 17.3242754,11.7371577 L12.0300757,6.88414142 L6.70710678,12.2071104 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 8.500003) scale(-1, 1) rotate(-360.000000) translate(-12.000003, -8.500003) "/>
    </g>
</svg><!--end::Svg Icon--></span><span class="totalLikes">' . $answer->totalLikes . '</span></a>
                                            <a data-idanswer=' . $answer->getId() . ' href="#" ' . (Application::$application->user && array_search((Application::$application->user)->getId(), $answer->dislikedUserIds) !== false ? 'style="background-color: #FFE2E5 !important;"' : '') . '
                                               class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-danger bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2 mr-2 dislike-answer">
                                                <span class="svg-icon svg-icon-danger svg-icon-md pr-2"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-down.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>
        <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>
    </g>
</svg><!--end::Svg Icon--></span><span class="totalDislikes">' . $answer->totalDislikes . '</span></a>
                                    </div>
                                    <!--end::Action-->';
                                    foreach ($answer->replies as $reply) {
                                        echo '<!--begin::Item-->
                                    <div class="d-flex py-5">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5 mt-1">
																<span class="symbol-label">
																	<img src="' . $reply->author->imgPath . '" class="h-75 align-self-end" alt="">
																</span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap">
                                                <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder pr-6">' . $reply->author->name . '</a>
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
                                    <h3 class="card-label">Your answer</h3>
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
                                            <img src="<?php echo $question->author->imgPath ?>" class="h-100 w-100 align-self-end" alt="" />
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Username-->
                                    <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1"><?php echo $question->author->name ?></a>
                                    <!--end::Username-->
                                    <!--begin::Info-->
                                    <div class="font-weight-bold text-dark-50 font-size-sm pb-6 text-center">
                                        Join <?php echo DateTimeUtil::getDiffForHumans($question->author->joinDate) ?>
                                        <br>
                                        Tier: <?php echo $question->author->tier ?>
                                        <br>
                                        Score: <?php echo $question->author->score ?>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="pt-1">
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
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Liked | disliked</a>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px"><?PHP echo $question->author->totalLikes ?> | <?PHP echo $question->author->totalDislikes ?></span>
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
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Questions</a>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px"><?PHP echo $question->author->totalQuestions ?></span>
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
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Answers</a>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::label-->
                                        <span class="font-weight-bolder label label-xl label-light-info label-inline py-5 min-w-45px"><?PHP echo $question->author->totalAnswers ?></span>
                                        <!--end::label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--eng::Container-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
                                <a class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" href="/account?id=<?PHP echo $question->author->getId()->__toString() ?>">View profile
                                </a>
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Nav Panel Widget 2-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script type="application/javascript">
    $('document').ready(() => {
        $("#like-question").click(function(event) {
            event.preventDefault();
            var question_id = "<?php echo $question->getId(); ?>";
            var totalLike = parseInt($(this).find('.totalLike-question').html());
            $.ajax({
                url: '/api/like',
                method: 'POST',
                dataType: 'json',
                data: {
                    question_id
                },
                success: function(data, textStatus, xhr) {
                    // console.log(xhr.status);
                    if (xhr.status == 201) {
                        $('.totalLike-question').html(totalLike + 1);
                        $("#like-question").attr('style', 'background-color: #D7F9EF !important');
                    }
                    if (xhr.status == 200) {
                        $('.totalLike-question').html(totalLike - 1);
                        $("#like-question").attr('style', 'background-color: white !important');

                    }

                },
                error: function(error) {
                    if (error.statusText == 'Unauthorized') {
                        alert("To like this question you need to login first");
                    }
                },
            });
        })
        $("#dislike-question").click(function(event) {
            event.preventDefault();
            var question_id = "<?php echo $question->getId(); ?>";
            var totalDislike = parseInt($(this).find('.totalDislike-question').html());
            $.ajax({
                url: '/api/dislike',
                method: 'POST',
                dataType: 'json',
                data: {
                    question_id
                },
                success: function(data, textStatus, xhr) {
                    // console.log(xhr.status);
                    if (xhr.status == 201) {
                        $('.totalDislike-question').html(totalDislike + 1);
                        $("#dislike-question").attr('style', 'background-color: #FFE2E5 !important');
                    }
                    if (xhr.status == 200) {
                        $('.totalDislike-question').html(totalDislike - 1);
                        $("#dislike-question").attr('style', 'background-color: white !important');
                    }
                },
                error: function(error) {
                    if (error.statusText == 'Unauthorized') {
                        alert("To dislike this question you need to login first");
                    }
                },
            });
        })
        $(document).on("click", ".like-answer", function(event) {
            event.preventDefault();
            var answer_id = $(this).data('idanswer');
            var question_id = "<?php echo $question->getId(); ?>";
            var totalLike = parseInt($(this).find('.totalLikes').html());
            $.ajax({
                url: 'api/like',
                method: "POST",
                dataType: 'json',
                data: {
                    answer_id,
                    question_id
                },
                success: function(data, textStatus, xhr) {
                    // console.log(xhr.status);
                    if (xhr.status == 201) {
                        // ($('.like-answer').find('.totalLikes')).html(totalLike + 1);
                        // $("a[data-idanswer=" + answer_id + "]")
                        ($("a[data-idanswer=" + answer_id + "]").find('.totalLikes')).html(totalLike + 1);
                        $("a[data-idanswer=" + answer_id + "]:first").attr('style', 'background-color: #D7F9EF !important');
                        // console.log("like");
                    }
                    if (xhr.status == 200) {
                        // ($('.like-answer').find('.totalLikes')).html(totalLike - 1);
                        ($("a[data-idanswer=" + answer_id + "]").find('.totalLikes')).html(totalLike - 1);
                        $("a[data-idanswer=" + answer_id + "]:first").attr('style', 'background-color: white !important');
                        // console.log("unlike");
                    }
                },
                error: function(error) {
                    if (error.statusText == 'Unauthorized') {
                        alert("To like this answer you need to login first");
                    }
                },
            });
        });
        $(document).on("click", ".dislike-answer", function(event) {
            event.preventDefault();
            var answer_id = $(this).data('idanswer');
            var question_id = "<?php echo $question->getId(); ?>";
            var totalDislikes = parseInt($(this).find('.totalDislikes').html());
            $.ajax({
                url: 'api/dislike',
                method: "POST",
                dataType: 'json',
                data: {
                    answer_id,
                    question_id
                },
                success: function(data, textStatus, xhr) {
                    // console.log(xhr.status);
                    if (xhr.status == 201) {
                        // ($('.dislike-answer').find('.totalDislikes')).html(totalLike + 1);
                        ($("a[data-idanswer=" + answer_id + "]").find('.totalDislikes')).html(totalDislikes + 1);
                        $("a[data-idanswer=" + answer_id + "]:last").attr('style', 'background-color: #FFE2E5 !important');

                    }
                    if (xhr.status == 200) {
                        // ($('.dislike-answer').find('.totalDislikes')).html(totalLike - 1);
                        ($("a[data-idanswer=" + answer_id + "]").find('.totalDislikes')).html(totalDislikes - 1);
                        $("a[data-idanswer=" + answer_id + "]:last").attr('style', 'background-color: white !important');
                    }
                },
                error: function(error) {
                    if (error.statusText == 'Unauthorized') {
                        alert("To dislike this answer you need to login first");
                    }
                },
            });
        });
    });

    function updateVote() {
        var id = "<?php echo $question->getId() ?>";
        $.ajax({
            url: "/api/questions",
            method: "GET",
            dataType: 'json',
            data: {
                id
            },
            success: function(question) {
                var totalLikeQuestion = $("#like-question").find(".totalLike-question");
                var totalDislikeQuestion = $('#dislike-question').find(".totalDislike-question")
                if (totalLikeQuestion.html() != question.totalLikes) {
                    totalLikeQuestion.html(question.totalLikes);
                }
                if (totalDislikeQuestion.html() != question.totalDislikes) {
                    totalDislikeQuestion.html(question.totalDislikes);
                }
                (question.answers).forEach(element => {
                    if (($("a[data-idanswer=" + element._id.$oid + "]").find('.totalLikes')).html() != element.totalLikes) {
                        ($("a[data-idanswer=" + element._id.$oid + "]").find('.totalLikes')).html(element.totalLikes);
                    }
                    if (($("a[data-idanswer=" + element._id.$oid + "]").find('.totalDislikes')).html() != element.totalDislikes) {
                        ($("a[data-idanswer=" + element._id.$oid + "]").find('.totalDislikes')).html(element.totalDislikes);
                    }
                });
            }
        })
    }
    setInterval(updateVote, 2000);
</script>