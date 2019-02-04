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
                <div class="buttons">
                    <?php if($content->formEmbed()): ?>
                        <?php echo $content->formEmbed(); ?>

                    <?php elseif($content->demoLink()): ?>
                        <?php echo $content->demoLink()->a(['button', 'button-white']); ?>

                    <?php endif; ?>
                    <?php if($content->videoLink()): ?>
                        <?php echo $content->videoLink()->a(['button', 'button-secondary']); ?>

                    <?php endif; ?>
                    <div class="button-arrow"></div>
                </div>
            </div>
            <div class="other">
                <div class="bg-other-ornament-1"></div>
                <?php echo $content->image()->img('hero'); ?>

            </div>
            <div class="arrow"></div>
        </div>
    </div>
</section>