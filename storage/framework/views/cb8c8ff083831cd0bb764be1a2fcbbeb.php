<?php
    $token = \Illuminate\Support\Str::random(40);
    session()->push('once_tokens', $token);
    session()->put('once_tokens', array_slice(session('once_tokens', []), -30)); // keep the list small
?>
<input type="hidden" name="_once" value="<?php echo e($token); ?>">
<?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/components/once.blade.php ENDPATH**/ ?>