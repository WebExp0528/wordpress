<?php /** @var Remesh\Content\MultiPagePanel $content */ ?>
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
            <?php echo $__env->yieldContent('header'); ?>
            <?php echo $__env->yieldContent('tabs'); ?>
            <div class="pages-container">
                <?php $__currentLoopData = $content->pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="page  <?php if($loop->first): ?> active <?php endif; ?>">
                    <div class="text">
                        <?php if(!empty($page->header())): ?>
                        <h2><?php echo $page->header(); ?></h2>
                        <?php endif; ?>
                        <p><?php echo $page->text(); ?></p>
                        <?php if($page->link()->valid()): ?>
                            <?php echo $page->link()->a(); ?>

                        <?php endif; ?>
                    </div>
                    <div class="image">
                        <?php if($page->image()): ?>
                            <?php echo $page->image()->img('multi-page'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="nav">
                <a href="#" class="previous">Previous</a>
                <a href="#" class="next">Next</a>
            </div>
            <?php echo $content->arrow()->render('arrow'); ?>

        </div>
    </div>
</section>
