<?php $__env->startSection('title', 'Sign in'); ?>
<?php $__env->startSection('content'); ?>
<section class="card">
    <h1>Welcome back</h1>
    <p class="lead">Sign in to continue.</p>

    <?php if(session('lockout')): ?>
        <div class="notice warn" data-lockout="<?php echo e(session('lockout')); ?>">
            Too many attempts. Try again in <b data-count><?php echo e(session('lockout')); ?></b>s.
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <label>Email
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>
        </label>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="err"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label>Password
            <span class="pass">
                <input type="password" id="password" name="password" autocomplete="current-password">
                <button type="button" class="link" data-toggle-pass="password">Show</button>
            </span>
        </label>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="err"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label class="check"><input type="checkbox" name="remember"> Keep me signed in</label>

        <button class="btn block" type="submit" data-lock-btn>Sign in</button>
    </form>

    <p class="foot">New here? <a href="<?php echo e(route('register')); ?>">Create an account</a></p>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/auth/login.blade.php ENDPATH**/ ?>