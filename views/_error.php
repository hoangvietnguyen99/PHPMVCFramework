<?php
/**
 * @var $exception Exception
 */
?>

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Error-->
    <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
         style="background-image: url(../assets/media/error/bg5.jpg);">
        <!--begin::Content-->
        <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
            <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">Oops!</h1>
            <p class="font-weight-boldest display-4"><?php echo $exception->getCode() ?></p>
            <p class="font-size-h3"><?php echo $exception->getMessage() ?></p>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Error-->
</div>
<!--end::Main-->