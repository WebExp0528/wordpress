<?php /** @var Remesh\Content\InformationPanel $content */ ?>
<?php if(!empty($content->identifier())): ?>
<a name="<?php echo e($content->identifier()); ?>"></a>
<?php endif; ?>
<section class="<?php echo e($content->containerCSS()); ?>">
    <div class="container">
        <div class="bg-ornament-1"></div>
        <div class="bg-ornament-2"></div>
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="bg-int-ornament-2"></div>
            <div class="info">
                <?php if(!empty($content->title())): ?>
                    <span class="sub-header"><?php echo e($content->title()); ?></span>
                <?php endif; ?>
                <?php if(!empty($content->header())): ?>
                    <h2><?php echo $content->header(); ?></h2>
                <?php endif; ?>
                <?php if(!empty($content->text())): ?>
                    <p><?php echo $content->text(); ?></p>
                <?php endif; ?>
                <?php if($content->link()->valid()): ?>
                    <div class="buttons">
                        <?php echo $content->link()->a(['button']); ?>

                        <?php echo $content->arrow()->render('button'); ?>

                    </div>
                <?php else: ?>
                        <?php echo $content->arrow()->render('button'); ?>

                <?php endif; ?>
                <?php echo $__env->yieldContent('info'); ?>
            </div>
            <div class="other" <?php if(!empty($other_attributes)): ?> <?php echo $other_attributes; ?> <?php endif; ?>>
                <div class="bg-other-ornament-1"></div>
                <div class="bg-other-ornament-2"></div>
                <?php echo $__env->yieldContent('other'); ?>
                <?php echo $content->arrow()->render('other'); ?>

            </div>
            <?php if($content->link()->valid()): ?>
                <div class="buttons-m">
                    <?php echo $content->link()->a(['button']); ?>

                    <?php echo $content->arrow()->render('button'); ?>

                </div>
            <?php else: ?>
                <?php echo $content->arrow()->render('button'); ?>

            <?php endif; ?>
            <?php echo $content->arrow()->render('arrow'); ?>

        </div>
    </div>
</section>