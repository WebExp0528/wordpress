<?php /** @var Remesh\Content\InformationPanel $content */ ?>


<?php $__env->startSection('other'); ?>
    <div class="grid">
        <div class="grid-row">
            <?php $__currentLoopData = $content->gridItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->link()->valid()): ?>
                <?php echo $item->link()->openA([],['data-transition'=>'fade', 'data-transition-index' => $loop->iteration]); ?>

                <?php else: ?>
                <a data-transition='fade' data-transition-index='<?php echo e($loop->iteration); ?>'>
                <?php endif; ?>
                    <div class="icon">
                        <div class="icon-image" style="background-image:url(<?php echo e($item->icon()->src()); ?>"></div>
                    </div>
                    <div>
                        <?php echo $item->title(); ?>  <?php if($item->link()->valid()): ?><span class="arrow"></span><?php endif; ?>
                    </div>
                </a>
                <?php if(($loop->iteration % 3 == 0) && ($loop->iteration < count($content->gridItems()))): ?>
        </div>
        <div class="grid-row">
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.content.information-panel.base-information-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>