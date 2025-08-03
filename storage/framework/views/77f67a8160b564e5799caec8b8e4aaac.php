

<?php $__env->startSection('content'); ?>
    <h1>Bem-vindo à Tabacaria Online!</h1>
    <p>Aqui você encontrará os melhores produtos de tabacaria.</p>
    <p>Explore nossos <a href="<?php echo e(url('/produtos')); ?>">produtos</a>.</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tabacaria-ecommerce\resources\views/home.blade.php ENDPATH**/ ?>