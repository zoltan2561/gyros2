<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.menu')); ?> | <?php echo e(@$categorydata->category_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(!empty($categorydata)): ?>
        <div class="breadcrumb-sec mb-3">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    <nav class="text-dark breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-dark fw-600" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                            </li>

                            
                            <li class="breadcrumb-item">
                                <a class="text-dark fw-600" href="<?php echo e(url('categories')); ?>"><?php echo e(trans('labels.categories')); ?></a>
                            </li>

                            
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo e($currentCategory->category_name ?? \Illuminate\Support\Str::headline(str_replace('-', ' ', request('category')))); ?>

                            </li>
                        </ol>

                    </nav>
                </div>
            </div>
        </div>
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="filter-sidebar mb-3">
                        <div class="sidebar-wrap" id="style-3">


                            
                            <?php if(request()->has('category')): ?>
                                <a href="<?php echo e(url('categories')); ?>"
                                   class="back-btn"
                                   aria-label="Vissza a kategóriákhoz">
                                    ← Vissza
                                </a>
                            <?php endif; ?>

                        <?php if(count($subcategories) > 0 || count($getitemlist) > 0 ): ?>
                            <a href="<?php echo e(URL::to('/menu?category='.$categorydata->slug)); ?>"
                                class="<?php if(!isset($_GET['subcategory'])): ?> active <?php endif; ?>"><?php echo e(trans('labels.all')); ?></a>
                            <?php endif; ?>


                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcatdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(URL::to('/menu?category=' . $categorydata->slug . '&subcategory=' . $subcatdata->slug)); ?>"
                                    class="<?php if(isset($_GET['subcategory']) && $_GET['subcategory'] == $subcatdata->slug): ?> active <?php endif; ?>"><?php echo e(ucfirst($subcatdata->subcategory_name)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php if(count($getitemlist) > 0): ?>
                        <div class="menu my-0">
                            <div class="row g-4 boxes">
                                <?php $__currentLoopData = $getitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('web.home1.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            <?php echo e($getitemlist->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<style>
    .back-btn{
        border-radius: 9999px;        /* szép “pill” forma */
        padding: .45rem .9rem;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        transition: all .2s ease;
        box-shadow: 0 1px 0 rgba(0,0,0,.02);
        text-decoration: none !important;
    }
    .back-btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        background-color: #ffffff;    /* finom kiemelés */
    }
    .back-btn:active{
        transform: translateY(0);
        box-shadow: 0 3px 10px rgba(0,0,0,.06) inset;
    }
    .back-btn:focus-visible{
        outline: 3px solid #86b7fe;   /* jó fókusz kontraszt */
        outline-offset: 2px;
    }
</style>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gyros2\resources\views/web/menu.blade.php ENDPATH**/ ?>