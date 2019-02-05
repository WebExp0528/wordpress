<?php $__env->startSection('main'); ?>
    <div class="content-item sys-error">
        <div class="error-container">
            <h1>Page Not Found</h1>

            <p>The page you're looking for has moved,<br/>
            been replaced, or is currently unavailable<br/>
                to view.</p>

            <a href="/" class="button">Return to Site</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>