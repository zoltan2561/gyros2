<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="<?php echo e(helper::appdata('')->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e(helper::appdata('')->meta_description); ?>" />
    <meta property="og:image" content='<?php echo e(helper::image_path(helper::appdata('')->og_image)); ?>' />
    <link rel="icon" href="<?php echo e(helper::image_path(helper::appdata('')->favicon)); ?>" type="image" sizes="16x16">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/bootstrap/bootstrap.min.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/fontawesome/all.min.css')); ?>">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/assets/css/style.css')); ?>">
    <!-- Custom CSS -->
    <title> <?php echo e(helper::appdata()->title); ?> </title>
</head>

<body>
    <div class="container">
        <div class="row align-items-md-center justify-content-md-center vh-md-100">
            <div class="col-md-6 error-sec-order">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h1 class="display-1 fw-bold">500</h1>
                        <p> <span class="text-danger error-content">Opps!</span></p>
                        <p class="text-uppercase fw-bold">Internal server error</p>
                        <p>We are currently trying to fix the problem.</p>
                        <a href="<?php echo e(URL::to('/')); ?>" class="btn btn-block btn-md btn-dark mb-2">Go To Home</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo e(url(env('ASSETSPATHURL') . 'admin-assets/images/404.svg')); ?>" class="w-100" alt="">
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\foody\resources\views/errors/500.blade.php ENDPATH**/ ?>