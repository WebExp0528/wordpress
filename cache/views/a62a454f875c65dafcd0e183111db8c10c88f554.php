<?php /** @var Remesh\Content\InformationTable $content */ ?>
<?php if(!empty($content->identifier())): ?>
    <a name="<?php echo e($content->identifier()); ?>"></a>
<?php endif; ?>
<section class="<?php echo e($content->containerCSS()); ?>">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="header">
                <?php if(!empty($content->title())): ?>
                <span class="sub-header"><?php echo e($content->title()); ?></span>
                <?php endif; ?>
                <?php if(!empty($content->header())): ?>
                <h2><?php echo $content->header(); ?></h2>
                <?php endif; ?>
                <?php if(!empty($content->link())): ?>
                    <?php echo $content->link()->a(); ?>

                <?php endif; ?>
                <?php if(!empty($content->text())): ?>
                    <p><?php echo $content->text(); ?></p>
                <?php endif; ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $content->arrow()->render('table'); ?>

        </div>
    </div>
</section>