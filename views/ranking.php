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
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap py-2 mr-3" style="margin-right: 0 !important;">
                                    <a <?php if ($users_previous == true) echo ' href=/ranking?month=' . ((int)$month - 1) . '&year=' . $year; ?> class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                                    <a class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1" style="width: 58px;"><?php echo $month . '/' . $year; ?></a>
                                    <a <?php if ($users_next == true) echo ' href=/ranking?month=' . ((int)$month + 1) . '&year=' . $year; ?> class="btn btn-icon btn-sm btn-light mr-2 my-1" style="margin-right: 0px !important;"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <?php $count = 1;
                    foreach ($top_user as $item) : ?>
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                <div class="symbol-label" style="height:96px;background-image: url('<?php echo  $item['users']['imgPath']; ?>')"></div>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <a href="/profile?id=<?php echo $item['users']['_id']; ?>" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><?php echo $item['users']['name']; ?></a>
                                <span class="text-muted font-weight-bold font-size-sm my-1"><?php echo $item['users']['email']; ?></span>
                                <span class="text-muted font-weight-bold font-size-sm">
                                    Score:
                                    <span class="text-primary font-weight-bold" style="font-weight: bold !important;"><?php echo $item['users']['score']; ?></span>
                                </span>
                                <span class="text-muted font-weight-bold font-size-sm">
                                    total question:
                                    <span class="text-primary font-weight-bold" style="font-weight: bold !important;"><?php echo $item['users']['totalQuestions']; ?></span>
                                </span>
                                <span class="text-muted font-weight-bold font-size-sm">
                                    total answer:
                                    <span class="text-primary font-weight-bold" style="font-weight: bold !important;"><?php echo $item['users']['totalAnswers']; ?></span>
                                </span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <i class="<?php if ($count == 1 || $count == 2 || $count ==  3) {
                                                    echo 'fas fa-star icon-4x';
                                                } else {
                                                    echo 'fas fa-circle icon-4x';
                                                } ?>" style="color:<?php switch ($count) {
                                                                        case 1:
                                                                            echo '#e1c503';
                                                                            break;
                                                                        case 2:
                                                                            echo '#acbfc7';
                                                                            break;
                                                                        case 3:
                                                                            echo '#b17e60';
                                                                            break;
                                                                        default:
                                                                            echo '#b7b7b7';
                                                                    } ?>;position:relative"><span class="ranking-order<?php if ($count == 1 || $count == 2 || $count == 3) echo '-top3'; ?>"><?php echo $count;
                                                                                                                                                                                                $count++; ?></span></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>