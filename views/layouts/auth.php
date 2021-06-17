<?php
/** @var $this View */

use app\core\Application;
use app\core\View;

?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo9/custom/pages/login/classic/login-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 May 2021 13:34:25 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo $this->title ?></title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="canonical" href="https://keenthemes.com/metronic"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="../assets/plugins/global/plugins.bundle7a50.css?v=7.2.7" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/custom/prismjs/prismjs.bundle7a50.css?v=7.2.7" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/style.bundle7a50.css?v=7.2.7" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon"
          href="https://preview.keenthemes.com/metronic/theme/html/demo9/dist/assets/media/logos/favicon.ico"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
        <div class="d-flex flex-column flex-lg-row flex-row-fluid text-center"
             style="background-image: url(../assets/media/bg/bg-3.jpg);">
            <!--begin:Aside-->
            <div class="d-flex w-100 flex-center p-15">
                <div class="login-wrapper">
                    <!--begin:Aside Content-->
                    <div class="text-dark-75">
                        <a href="/">
                            <img src="../assets/media/logos/logo-letter-13.png" class="max-h-75px" alt=""/>
                        </a>
                        <h3 class="mb-8 mt-22 font-weight-bold">JOIN OUR COMMUNITY</h3>
                        <p class="mb-15 text-muted font-weight-bold">The Vietnamese social</p>
                        <a href="/signup">
                            <button type="button"
                                    class="btn btn-outline-primary btn-pill py-4 px-9 font-weight-bold">Get An Account
                            </button>
                        </a>
                    </div>
                    <!--end:Aside Content-->
                </div>
            </div>
            <!--end:Aside-->
            <!--begin:Divider-->
            <div class="login-divider">
                <div></div>
            </div>
            <!--end:Divider-->
            <!--begin:Content-->
            <div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
                <div class="login-wrapper">
                    {{content}}
                </div>
            </div>
            <!--end:Content-->
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>const KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#0BB783",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#D7F9EF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="../assets/plugins/global/plugins.bundle7a50.js?v=7.2.7"></script>
<script src="../assets/plugins/custom/prismjs/prismjs.bundle7a50.js?v=7.2.7"></script>
<script src="../assets/js/scripts.bundle7a50.js?v=7.2.7"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="../assets/js/pages/custom/login/login-general7a50.js?v=7.2.7"></script>
<!--end::Page Scripts-->
<!--begin::Page Scripts(used by this page)-->
<!--<script src="../assets/js/pages/features/miscellaneous/bootstrap-notify7a50.js?v=7.2.7"></script>-->
<!--end::Page Scripts-->
<div id="errors" data-errors='<?php
echo json_encode(Application::$application->session->getFlash('error'));
?>'></div>
<div id="success" data-success='<?php
echo Application::$application->session->getFlash('success');
?>'></div>

<script type="application/javascript">
    $('document').ready(() => {
        const errors = JSON.parse(document.querySelector('#errors').dataset.errors);
        const success = document.querySelector('#success').dataset.success;
        console.log(errors, success);
        if (success) {
            $.notify({
                message: success,
            }, {
                allow_dismiss: true,
                animate: {enter: "animate__animated animate__bounce", exit: "animate__animated animate__bounce"},
                delay: "1000",
                mouse_over: false,
                newest_on_top: false,
                offset: {x: "30", y: "30"},
                placement: {from: "top", align: "right"},
                showProgressbar: false,
                spacing: "10",
                timer: "2000",
                type: "success",
                z_index: "10000",
            });
        }
        for (const error in errors) {
            $.notify({
                message: errors[error],
            }, {
                allow_dismiss: true,
                animate: {enter: "animate__animated animate__bounce", exit: "animate__animated animate__bounce"},
                delay: "1000",
                mouse_over: false,
                newest_on_top: false,
                offset: {x: "30", y: "30"},
                placement: {from: "top", align: "right"},
                showProgressbar: false,
                spacing: "10",
                timer: "2000",
                type: "danger",
                z_index: "10000",
            });
        }
    })
</script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo9/custom/pages/login/classic/login-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 May 2021 13:34:25 GMT -->
</html>