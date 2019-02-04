<?php /** @var Remesh\Content\InformationTable $content */ ?>



<?php $__env->startSection('content'); ?>
    <div class="table">
        <div class="bg-other-ornament-1"></div>
        <ul>
            <?php $__currentLoopData = $content->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li data-transition='fade' data-transition-index='<?php echo e($loop->iteration); ?>'>
                    <?php if($content->type() == 'vertical-cell'): ?>
                        <?php echo $item->image()->img('table-landscape'); ?>

                    <?php else: ?>
                        <div class="image" style="background-image: url(<?php echo $item->image()->src('table-portrait'); ?>)"></div>
                    <?php endif; ?>
                    <div>
                        <h4><?php echo e($item->title()); ?></h4>
                        <p><?php echo e($item->text()); ?></p>
                        <?php echo $item->link()->a(); ?>

                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.content.stacked-panel.base-stacked-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>