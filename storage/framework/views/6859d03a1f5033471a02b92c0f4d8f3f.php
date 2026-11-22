<?php $__env->startSection('title', 'Create account'); ?>
<?php $__env->startSection('content'); ?>
<section class="card">
    <h1>Create your account</h1>
    <p class="lead">It only takes a moment.</p>

    <?php if(session('error')): ?> <div class="notice warn"><?php echo e(session('error')); ?></div> <?php endif; ?>

    <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.once','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('once'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae8554ecbfd667a0d86b9c0e4411a6a0)): ?>
<?php $attributes = $__attributesOriginalae8554ecbfd667a0d86b9c0e4411a6a0; ?>
<?php unset($__attributesOriginalae8554ecbfd667a0d86b9c0e4411a6a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0)): ?>
<?php $component = $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0; ?>
<?php unset($__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0); ?>
<?php endif; ?>
        <label>Full name
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" autocomplete="name" autofocus>
        </label>
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="err"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label>Email
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email">
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
                <input type="password" id="password" name="password" autocomplete="new-password">
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

        <label>Confirm password
            <input type="password" name="password_confirmation" autocomplete="new-password">
        </label>

        <button class="btn block" type="submit">Create account</button>
    </form>

    <p class="foot">Already registered? <a href="<?php echo e(route('login')); ?>">Sign in</a></p>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/auth/register.blade.php ENDPATH**/ ?>