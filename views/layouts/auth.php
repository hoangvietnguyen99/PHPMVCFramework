<?PHP
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
<head><base href="../../../../">
    <meta charset="utf-8" />
    <title><?php echo $this->title ?></title>
    <meta name="description" content="Singin page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
{{content}}
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<!--<script src="assets/js/pages/custom/login/login-3.js"></script>-->
<!--end::Page Scripts-->
<script type="application/javascript">
    $('document').ready(() => {
        const errors = JSON.parse('<?php echo json_encode(Application::$application->session->getFlash('error')) ?>') || [];
        const success = '<?php echo Application::$application->session->getFlash('success') ?>';
        if (success) {
            $.notify({
                message: success,
            }, {
                allow_dismiss: true,
                animate: {
                    enter: "animate__animated animate__bounce",
                    exit: "animate__animated animate__bounce"
                },
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
<?php echo implode('', $this->scripts) ?>
</body>
<!--end::Body-->
</html>