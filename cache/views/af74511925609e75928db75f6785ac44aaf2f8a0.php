<?php /** @var Remesh\Content\Hero $content */ ?>
<section class="<?php echo e($content->style()); ?>">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="info">
                <h1><?php echo $content->title(); ?></h1>
                <p><?php echo $content->text(); ?></p>
            </div>
            <div class="other">
                <div class="bg-other-ornament-1"></div>
                <?php echo $content->image()->img('hero'); ?>

            </div>
            <?php if(!empty($content->formEmbed())): ?>
            <?php echo $content->formEmbed(); ?>

            <?php else: ?>
            <?php echo $__env->make('partials.content.demo-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>