<?php /** @var Remesh\Content\MultiButtonPanel $content */ ?>
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
                <?php if(!empty($content->text())): ?>
                    <p><?php echo $content->text(); ?></p>
                <?php endif; ?>
            </div>
            <div class="buttons-container">
                <?php $__currentLoopData = $content->buttons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($button->link()->valid()): ?>
                        <div class="button" data-transition='fade' data-transition-index='<?php echo e($loop->iteration); ?>'>
                    <?php echo $button->link()->openA(); ?>

                        <?php if($button->icon()): ?>
                            <?php echo $button->icon()->img(); ?>

                        <?php endif; ?>
                        <h3><?php echo $button->title(); ?></h3>
                        <p><?php echo $button->description(); ?></p>
                    <?php echo $button->link()->closeA(); ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $content->arrow()->render('arrow'); ?>

        </div>
    </div>
</section>
