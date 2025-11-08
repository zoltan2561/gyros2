<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th><?php echo e(trans('labels.image')); ?></th>
            <th><?php echo e(trans('labels.title')); ?></th>
            <th><?php echo e(trans('labels.subtitle')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody id="tabledetails" data-url="<?php echo e(url('admin/choose_us/reorder_choose_us')); ?>">
        <?php $i = 1; ?>
        <?php $__currentLoopData = $getwhychooseus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whychooseus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="row1" data-id="<?php echo e($whychooseus->id); ?>">
                <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                <td><?php echo $i++; ?></td>
                <td><img src='<?php echo e(helper::image_path($whychooseus->image)); ?>' class='img-fluid rounded h-50px'></td>
                <td><?php echo e($whychooseus->title); ?></td>
                <td><?php echo e($whychooseus->subtitle); ?></td>
                <td>
                    <div class="d-flex flex-wrap gap-1">
                        <a class="btn btn-sm btn-info square" tooltip="<?php echo e(trans('labels.edit')); ?>"
                            href="<?php echo e(URL::to('admin/choose_us-' . $whychooseus->id)); ?>">
                            <i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-sm btn-danger square" tooltip="<?php echo e(trans('labels.delete')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="Delete('<?php echo e($whychooseus->id); ?>','<?php echo e(URL::to('admin/choose_us/delete')); ?>')" <?php endif; ?>>
                            <i class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/why_choose_us/table.blade.php ENDPATH**/ ?>