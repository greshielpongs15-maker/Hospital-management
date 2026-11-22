<?php $__env->startSection('title', 'Welcome'); ?>
<?php $__env->startSection('content'); ?>
<section class="card hero">
    <p class="eyebrow">Patient care, made calm</p>
    <h1><?php echo e(config('app.name')); ?></h1>
    <p class="lead">Patients, appointments and consultations, gently organised in one quiet place.</p>
    <div class="actions">
        <a class="btn" href="<?php echo e(route('login')); ?>">Sign in</a>
        <a class="btn ghost" href="<?php echo e(route('register')); ?>">Create account</a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/welcome.blade.php ENDPATH**/ ?>