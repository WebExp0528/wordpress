<?php /** @var Remesh\Content\StepsPanel $content */ ?>
<?php if(!empty($content->identifier())): ?>
    <a name="<?php echo e($content->identifier()); ?>"></a>
<?php endif; ?>
<section class="<?php echo e($content->containerCSS()); ?>">
    <div class="container">
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="bg-int-ornament-2"></div>
            <div class="header">
                <span class="sub-header"><?php echo e($content->title()); ?></span>
            </div>
            <ul class="steps">
                <?php $__currentLoopData = $content->steps(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="step-container" data-transition='fade' data-transition-index='<?php echo e($loop->iteration); ?>'>
                        <div class="header">
                            <span class="step"><?php echo e($loop->index + 1); ?></span>
                            <hr>
                        </div>
                        <h3><?php echo e($step->title()); ?></h3>
                        <div class="responsive">
                            <span class="step"><?php echo e($loop->index + 1); ?></span>
                            <h3><?php echo e($step->title()); ?></h3>
                        </div>
                        <p><?php echo e($step->text()); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php echo $content->arrow()->render('arrow'); ?>

        </div>
    </div>
</section>