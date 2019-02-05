<?php /** @var Remesh\Content\InformationPanel $content */ ?>



<?php $__env->startSection('other'); ?>
    <?php echo $content->image()->img('hero-fit'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.content.information-panel.base-information-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>