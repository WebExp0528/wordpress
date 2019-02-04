<?php 
$hasAnnouncement = get_field('announcements_enabled', 'options');
$announcement = get_field('announcement', 'options');
 ?>
<!DOCTYPE html>
<html <?php echo e(language_attributes()); ?> lang="en">
    <head>
        <meta charset="<?php echo e(bloginfo( 'charset' )); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="distribution" content="global" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#FC5047s">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        
        <?php echo Stem\Core\Context::current()->ui->header(); ?>
        
        <?php echo $__env->yieldContent('head'); ?>
    </head>
    <body class="<?php echo $__env->yieldContent('body-classes'); ?> <?php if(getenv('WP_ENV')=='development'): ?> debug <?php endif; ?> <?php echo e($body_class); ?> <?php if($hasAnnouncement): ?> has-announcement <?php endif; ?>">
        <div id="breakpoints"></div>
        
        <div id="breakpoint-debug"></div>
        <?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>


        <header>
            <?php if($hasAnnouncement): ?>
                <div id="announcement">
                    <?php echo $announcement; ?>

                </div>
            <?php endif; ?>
            <div class="interior">
                <a href="/"><?php echo Stem\External\Blade\Directives\InlineSVGDirective::InlineSVG('logo-remesh.svg'); ?></a>
                <nav>
                    <?php echo Remesh\Directives\RemeshNavDirective::OutputFlatMenu('primary'); ?>
                    <button class="hamburger hamburger--spin" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </nav>

                <div id="mobile-menu" class="removed hidden">
                    <div class="header">
                        <a href="/"><?php echo Stem\External\Blade\Directives\InlineSVGDirective::InlineSVG('logo-remesh.svg'); ?></a>
                    </div>
                    <div class="contents">
                        <?php echo Remesh\Directives\RemeshMenuTemplateDirective::OutputFlatMenu('primary', 'partials.mobile-menu'); ?>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <?php echo $__env->yieldContent('main'); ?>
            <footer>
                <div class="interior">
                    <div class="header">
                        <a href="/"><?php echo Stem\External\Blade\Directives\InlineSVGDirective::InlineSVG('logo-remesh.svg'); ?></a>
                        <span class="footer-header">Newsletter</span>
                    </div>
                    <div class="columns">
                        <div class="left">
                            <p><?php echo get_field('footer_text', 'options'); ?></p>
                            <div class="social">
                                <?php echo Remesh\Directives\RemeshSocialMenuDirective::OutputMobileMenu('social'); ?>
                            </div>
                        </div>
                        <div class="middle">
                            <nav>
                                <?php echo Stem\External\Blade\Directives\FlatMenuDirective::OutputFlatMenu('footer'); ?>
                            </nav>
                        </div>
                        <div class="right">
                            <span class="footer-header">Newsletter</span>
                            <?php echo get_field('footer_form_embed', 'options'); ?>

                            <div class="social">
                                <?php echo Remesh\Directives\RemeshSocialMenuDirective::OutputMobileMenu('social'); ?>
                            </div>
                            <span class="copy">&copy;<?php echo e(date('Y')); ?>&nbsp;&nbsp;|&nbsp;&nbsp;All rights reserved</span>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('footer'); ?>
            </footer>
        </main>



        
        <?php echo Stem\Core\Context::current()->ui->footer(); ?>

        
        <?php echo $__env->yieldContent('scripts'); ?>

        
        <?php echo $__env->make('partials/analytics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>