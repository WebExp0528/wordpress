<?php /** @var Remesh\Content\DemoFormPanel $content */ ?>
<?php if(!empty($content->identifier())): ?>
    <a name="<?php echo e($content->identifier()); ?>"></a>
<?php endif; ?>
<section class="<?php echo e($content->containerCSS()); ?>">
    <div class="container">
        <div class="interior">
            <div class="left">
                <?php if(!empty($content->header())): ?>
                    <h2><?php echo $content->header(); ?></h2>
                <?php endif; ?>
                <?php if(!empty($content->text())): ?>
                    <p><?php echo $content->text(); ?></p>
                <?php endif; ?>
                <ul>
                    <?php $__currentLoopData = $content->bulletPoints(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulletPoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <span class="number"><?php echo e($loop->index + 1); ?></span>
                            <p><?php echo e($bulletPoint); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="right">
                <?php if(!empty($content->formEmbed())): ?>
                    <?php echo $content->formEmbed(); ?>

                <?php else: ?>
                    <?php echo $__env->make('partials.content.demo-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>