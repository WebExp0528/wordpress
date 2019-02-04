<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>



<?php $__env->startSection('header'); ?>
    <div class="header">
        <?php if(!empty($content->title())): ?>
            <span class="sub-header"><?php echo e($content->title()); ?></span>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('tabs'); ?>
    <?php if(count($content->pages()) > 1): ?>
        <div class="tabs">
            <?php $__currentLoopData = $content->pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->first): ?>
                    <a href="#" class="multi-page-tab active">
                        <?php if($page->tabIcon()): ?>
                            <?php echo $page->tabIcon()->img(); ?>

                        <?php endif; ?>
                        <p><?php echo $page->tabTitle(); ?></p>
                    </a>
                <?php else: ?>
                    <a href="#" class="multi-page-tab">
                        <?php if($page->tabIcon()): ?>
                            <?php echo $page->tabIcon()->img(); ?>

                        <?php endif; ?>
                        <p><?php echo $page->tabTitle(); ?></p>
                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.content.multi-page-panel.base-multi-page-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>