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
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">My Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Apps</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Education</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Student</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Dashboard</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Actions</a>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="svg-icon svg-icon-success svg-icon-2x">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"/>
														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                              fill="#000000" fill-rule="nonzero" opacity="0.3"/>
														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                                              fill="#000000"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header font-weight-bold py-4">
                                <span class="font-size-lg">Choose Label:</span>
                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip"
                                   data-placement="right" title="Click to learn more..."></i>
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
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
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
                                        <span class="text-muted font-weight-bold font-size-lg">What’s on your mind, <?php echo $user->firstName ?></span>
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
																	<img src="assets/media/svg/avatars/007-boy-2.svg"
                                                                         class="h-75 align-self-end" alt=""/>
																</span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Username-->
                                        <a href="#"
                                           class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">Jerry
                                            Kane</a>
                                        <!--end::Username-->
                                        <!--begin::Info-->
                                        <div class="font-weight-bold text-dark-50 font-size-sm pb-6">Grade 8, AE3
                                            Student
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
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<rect fill="#000000" opacity="0.3"
                                                                                          x="13" y="4" width="3"
                                                                                          height="16" rx="1.5"/>
																					<rect fill="#000000" x="8" y="9"
                                                                                          width="3" height="11"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="18" y="11"
                                                                                          width="3" height="9"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="3" y="13"
                                                                                          width="3" height="7"
                                                                                          rx="1.5"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#"
                                                   class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Ricky
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
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<rect fill="#000000" x="4" y="4"
                                                                                          width="7" height="7"
                                                                                          rx="1.5"/>
																					<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                                          fill="#000000" opacity="0.3"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#"
                                                   class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Modules</a>
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
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                                          fill="#000000"
                                                                                          fill-rule="nonzero"/>
																					<circle fill="#000000" opacity="0.3"
                                                                                            cx="12" cy="10" r="6"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#"
                                                   class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Progress</a>
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
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                     data-toggle="tooltip" title="" data-placement="right"
                                     data-original-title="Chat Example">
                                    <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14"
                                            data-toggle="modal" data-target="#kt_chat_modal">Write a Message
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
                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                                     data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                        <div class="symbol-label min-w-65px min-h-100px"
                                             style="background-image: url('assets/media/books/4.png')"></div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <a href="#"
                                           class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Darius
                                            The Great</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
															<br/>Darius greatness</span>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div>
                                            <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
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
                                        <div class="symbol-label min-w-65px min-h-100px"
                                             style="background-image: url('assets/media/books/12.png')"></div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <a href="#"
                                           class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Wild
                                            Blues</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
															<br/>Darius greatness</span>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div>
                                            <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
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
                                        <div class="symbol-label min-w-65px min-h-100px"
                                             style="background-image: url('assets/media/books/13.png')"></div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <a href="#"
                                           class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Simple
                                            Thinking</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
															<br/>Darius greatness</span>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div>
                                            <button type="button"
                                                    class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now
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
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            <li class="navi-header font-weight-bold py-4">
                                                <span class="font-size-lg">Choose Label:</span>
                                                <i class="flaticon2-information icon-md text-muted"
                                                   data-toggle="tooltip" data-placement="right"
                                                   title="Click to learn more..."></i>
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
</div>
<!--end::Content-->