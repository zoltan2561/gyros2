<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th><?php echo e(trans('labels.category')); ?></th>
            <th><?php echo e(trans('labels.featured')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>
            <th><?php echo e(__('Ma nem elérhető')); ?></th>

            <th><?php echo e(trans('labels.created_date')); ?></th>
            <th><?php echo e(trans('labels.updated_date')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody id="tabledetails" data-url="<?php echo e(url('admin/item/reorder_item')); ?>">
        <?php $i = 1; ?>
        <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="row1" data-id="<?php echo e($item->id); ?>">
                <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                <td><?php echo $i++; ?></td>
                <td><img <?php if($item->item_type == 1): ?> src="<?php echo e(helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                        class="item-type-img" alt=""> <?php echo e($item->item_name); ?></td>
                <td><?php echo e(@$item['category_info']->category_name); ?></td>
                <td>
                    <?php if($item->is_featured == 1): ?>
                        <a class="btn btn-sm btn-success square" tooltip="<?php echo e(trans('labels.active')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                    <?php else: ?> onclick="StatusFeatured('<?php echo e($item->id); ?>','2','<?php echo e(URL::to('admin/item/featured')); ?>')" <?php endif; ?>><i
                                class="fa-sharp fa-solid fa-check"></i></a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-danger square" tooltip="<?php echo e(trans('labels.deactive')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                    <?php else: ?> onclick="StatusFeatured('<?php echo e($item->id); ?>','1','<?php echo e(URL::to('admin/item/featured')); ?>')" <?php endif; ?>><i
                                class="fa-sharp fa-solid fa-xmark"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($item->item_status == 1): ?>
                        <a class="btn btn-sm btn-success square" tooltip="<?php echo e(trans('labels.active')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                    <?php else: ?> onclick="StatusUpdate('<?php echo e($item->id); ?>','2','<?php echo e(URL::to('admin/item/status')); ?>')" <?php endif; ?>>
                            <i class="fa-sharp fa-solid fa-check"></i></a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-danger square" tooltip="<?php echo e(trans('labels.deactive')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                    <?php else: ?> onclick="StatusUpdate('<?php echo e($item->id); ?>','1','<?php echo e(URL::to('admin/item/status')); ?>')" <?php endif; ?>>
                            <i class="fa-sharp fa-solid fa-xmark"></i></a>
                    <?php endif; ?>
                </td>


                <td>
                    <?php if($item->today_unavailable == 0): ?>
                        
                        <a class="btn btn-sm btn-danger square"
                           tooltip="Ma nem elérhető"
                           onclick="ToggleTodayUnavailable('<?php echo e($item->id); ?>','<?php echo e(route('admin.item.today-unavailable')); ?>')">
                            <i class="fa-sharp fa-solid fa-xmark"></i>
                        </a>
                    <?php else: ?>
                        
                        <a class="btn btn-sm btn-success square"
                           tooltip="Ma elérhető (kattintva letiltod mára)"
                           onclick="ToggleTodayUnavailable('<?php echo e($item->id); ?>','<?php echo e(route('admin.item.today-unavailable')); ?>')">
                            <i class="fa-sharp fa-solid fa-check"></i>
                        </a>
                    <?php endif; ?>
                </td>





                <td>
                    <?php echo e(helper::date_format($item->created_at)); ?> <br>
                    <?php echo e(helper::time_format($item->created_at)); ?>

                </td>
                <td>
                    <?php echo e(helper::date_format($item->updated_at)); ?> <br>
                    <?php echo e(helper::time_format($item->updated_at)); ?>

                </td>
                <td>
                    <div class="d-flex flex-wrap gap-1">
                        <a class="btn btn-sm btn-info square" tooltip="<?php echo e(trans('labels.edit')); ?>"
                            href="<?php echo e(URL::to('admin/item-' . $item->id)); ?>"> <i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-sm btn-danger square" tooltip="<?php echo e(trans('labels.delete')); ?>"
                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()"
                        <?php else: ?> onclick="Delete('<?php echo e($item->id); ?>','<?php echo e(URL::to('admin/item/delete')); ?>')" <?php endif; ?>>
                            <i class="fa fa-trash"></i></a>
                    </div>
                </td>


            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<script>
    function ToggleTodayUnavailable(id, url) {
        // ha van, vedd a globális tokenből; ha nincs, így is jó:
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        $.ajax({
            url: url,
            method: 'POST',
            data: { id: id, _token: token },
            beforeSend: function(){
                // opcionális: loading állapot
            },
            success: function(res){
                if (res && res.success) {
                    // 1) Minimál: frissítsük az oldalt, biztos vizuális állapotváltás
                    location.reload();

                    // 2) Ha nem akarsz reloadot, akkor itt cseréld a gomb színét/ikonját
                    // és tooltipjét (de a reload a legegyszerűbb és bombabiztos).
                } else {
                    alert('Nem sikerült frissíteni.');
                }
            },
            error: function(xhr){
                console.error(xhr.responseText || xhr.statusText);
                alert('Hiba történt a frissítés közben.');
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\gyros2\resources\views/admin/item/table.blade.php ENDPATH**/ ?>