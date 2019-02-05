<?php /** @var Remesh\Content\BiosList $content */ ?>
<?php if(!empty($content->identifier())): ?>
    <a name="<?php echo e($content->identifier()); ?>"></a>
<?php endif; ?>
<script>
    var animatedSquiggles = <?php echo get_field('animated_squiggles', 'options') ? 'true' : 'false'; ?>;
    var animatedSquiggleDelay = <?php echo e(get_field('animation_delay', 'options') ? get_field('animation_delay', 'options') : 100); ?>;
    var squiggleColors = <?php echo json_encode(explode("\n", str_replace("\r", "", get_field('squiggle_colors', 'options')))); ?>;
</script>
<section class="<?php echo e($content->containerCSS()); ?>">
    <div class="container">
        <div class="interior">
            <div class="bg-int-ornament-1"></div>
            <div class="info">
                <div class="header">
                    <span class="sub-header"><?php echo e($content->title()); ?></span>
                    <h2><?php echo $content->header(); ?></h2>
                </div>
            </div>
            <div class="bios">
                <div class="squiggle">
                    <?php echo Stem\External\Blade\Directives\InlineSVGDirective::InlineSVG('ui-squiggles.svg'); ?>
                </div>
                <?php if(count($content->founders()) > 0): ?>
                <div class="founders">
                    <ul>
                        <?php $__currentLoopData = $content->founders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="bio-list-image">
                                    <?php if(!empty($founder->thumbnail())): ?>
                                    <?php echo $founder->thumbnail()->img('bio'); ?>

                                    <?php endif; ?>
                                </div>
                                <span class="name"><?php echo e($founder->title()); ?></span>
                                <span class="title"><?php echo e($founder->jobTitle()); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="employees">
                    <ul>
                        <?php $__currentLoopData = $content->employees(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="bio-list-image">
                                    <?php if(!empty($employee->thumbnail())): ?>
                                        <?php echo $employee->thumbnail()->img('bio'); ?>

                                    <?php endif; ?>
                                </div>
                                <span class="name"><?php echo e($employee->title()); ?></span>
                                <span class="title"><?php echo e($employee->jobTitle()); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <?php echo $content->arrow()->render('arrow'); ?>

        </div>
    </div>
</section>