<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>



<?php $__env->startSection('header'); ?>
    <div class="header">
        <?php if(!empty($content->title())): ?>
            <span class="sub-header"><?php echo e($content->title()); ?></span>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.content.multi-page-panel.base-multi-page-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>