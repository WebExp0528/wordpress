<?php /** @var Remesh\Content\InformationTable $content */ ?>



<?php $__env->startSection('content'); ?>
    <div class="client-list">
        <ul>
            <?php $__currentLoopData = $content->clients(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php echo $client->image()->img(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.content.stacked-panel.base-stacked-panel', ['content' => $content], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>