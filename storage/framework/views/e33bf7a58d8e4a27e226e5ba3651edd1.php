<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> · <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body class="dash">
    <div class="shell">
        <header class="bar glass">
            <a class="brand" href="<?php echo e(route('dashboard')); ?>"> <?php echo e(config('app.name')); ?></a>
            <div class="who">
                <span><?php echo e(auth()->user()->name); ?></span>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                    <button class="btn ghost sm" type="submit">Sign out</button>
                </form>
            </div>
        </header>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/layouts/app.blade.php ENDPATH**/ ?>