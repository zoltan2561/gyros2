<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.tax')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(trans('labels.created_date')); ?></th>
            <th><?php echo e(trans('labels.updated_date')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody id="tabledetails" data-url="<?php echo e(url('admin/tax/reorder_tax')); ?>">
        <?php $i = 1 ?>
        <?php $__currentLoopData = $gettax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="row1" data-id="<?php echo e($tax->id); ?>">
                <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                <td><?php echo $i++ ?></td>
                <td><?php echo e($tax->name); ?></td>
                <td>
                    <?php if($tax->type == 1): ?>
                        <?php echo e(helper::currency_format($tax->tax)); ?>

                    <?php else: ?>
                        <?php echo e($tax->tax); ?>%
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($tax->is_available == 1): ?>
                        <a class="btn btn-sm btn-success square hov" tooltip="<?php echo e(trans('labels.active')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="StatusUpdate('<?php echo e($tax->id); ?>','2','<?php echo e(URL::to('admin/tax/status')); ?>')" <?php endif; ?>><i
                                class="fa-sharp fa-solid fa-check"></i></a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-danger square hov" tooltip="<?php echo e(trans('labels.deactive')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="StatusUpdate('<?php echo e($tax->id); ?>','1','<?php echo e(URL::to('admin/tax/status')); ?>')" <?php endif; ?>><i
                                class="fa-sharp fa-solid fa-xmark"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo e(helper::date_format($tax->created_at)); ?> <br>
                    <?php echo e(helper::time_format($tax->created_at)); ?>

                </td>
                <td>
                    <?php echo e(helper::date_format($tax->updated_at)); ?> <br>
                    <?php echo e(helper::time_format($tax->updated_at)); ?>

                </td>
                <td>
                    <div class="d-flex flex-wrap gap-1">
                        <a class="btn btn-sm btn-info square hov" tooltip="<?php echo e(trans('labels.edit')); ?>"
                            href="<?php echo e(URL::to('admin/tax-' . $tax->id)); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-sm btn-danger square hov" tooltip="<?php echo e(trans('labels.delete')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="Delete('<?php echo e($tax->id); ?>','<?php echo e(URL::to('admin/tax/delete')); ?>')" <?php endif; ?>><i
                                class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/tax/taxtable.blade.php ENDPATH**/ ?>