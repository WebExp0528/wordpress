<?php $__env->startSection('main'); ?>
    
    <?php $__currentLoopData = $content->content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $contentItem->render(['errors'=>$errors, 'params'=>$params, 'first' => $loop->first, 'last' => $loop->last]); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->yieldContent('additional'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/page', ['body_class' => (empty($body_class) ? '' : $body_class)], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>