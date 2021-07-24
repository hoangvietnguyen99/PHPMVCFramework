<?PHP

/** @var $this View */

use app\core\View;
use app\core\Application;

$this->title = 'Ranking';
?>
<!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container" style="width:700px;">
            <!--begin::List Widget 14-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">USER RANKING</h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-ver"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
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
                                            <i class="ki ki-plus icon-sm"></i>Add new
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
                <div class="card-body pt-2">
                    <!--begin::Item-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="height:96px;background-image: url('assets/media/users/100_12.jpg')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Humbert Bresnen</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">hbresnen1@theguardian.com</span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Score:
                                <span class="text-primary font-weight-bold">500</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total question:
                                <span class="text-primary font-weight-bold">100</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total answer:
                                <span class="text-primary font-weight-bold">50</span>
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <i class="fas fa-star icon-4x" style="color:#e1c503;position:relative"><span class="ranking-order-top3">1</span></i>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Item-->
                    <!--begin: Item-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="height:96px;background-image: url('assets/media/users/100_11.jpg')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Jareb Labro</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">jlabro2@kickstarter.com</span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Score:
                                <span class="text-primary font-weight-bold">500</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total question:
                                <span class="text-primary font-weight-bold">100</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total answer:
                                <span class="text-primary font-weight-bold">50</span>
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <i class="fas fa-star icon-4x" style="color:#acbfc7;position:relative"><span class="ranking-order-top3">2</span></i>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end: Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="height:96px;background-image: url('assets/media/users/100_9.jpg')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 pr-3">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Hayes Boule</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">hboule0@hp.com</span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Score:
                                <span class="text-primary font-weight-bold">500</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total question:
                                <span class="text-primary font-weight-bold">100</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total answer:
                                <span class="text-primary font-weight-bold">50</span>
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <i class="fas fa-star icon-4x" style="color:#b17e60;position:relative"><span class="ranking-order-top3">3</span></i>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="height:96px;background-image: url('assets/media/users/100_10.jpg')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Krishnah Tosspell</a>
                            <span class="text-muted font-size-sm font-weight-bold my-1">dkernan4@mapquest.com</span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Score:
                                <span class="text-primary font-weight-bold">500</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total question:
                                <span class="text-primary font-weight-bold">100</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total answer:
                                <span class="text-primary font-weight-bold">50</span>
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <i class="fas fa-circle icon-4x" style="color:#b7b7b7;position:relative"><span class="ranking-order">4</span></i>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-wrap align-items-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                            <div class="symbol-label" style="height:96px;background-image: url('assets/media/users/100_14.jpg')"></div>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Arlie Larking</a>
                            <span class="text-muted font-weight-bold font-size-sm my-1">alarkingg@elegantthemes.com</span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                Score:
                                <span class="text-primary font-weight-bold">500</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total question:
                                <span class="text-primary font-weight-bold">100</span>
                            </span>
                            <span class="text-muted font-weight-bold font-size-sm">
                                total answer:
                                <span class="text-primary font-weight-bold">50</span>
                            </span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-center py-lg-0 py-2">
                            <div class="d-flex flex-column text-right">
                                <i class="fas fa-circle icon-4x" style="color:#b7b7b7;position:relative"><span class="ranking-order">5</span></i>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List Widget 14-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->