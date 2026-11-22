<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $h = now()->format('H');
    $hello = $h < 12 ? 'Good morning' : ($h < 18 ? 'Good afternoon' : 'Good evening');
    $open = old('_form', 'patient');
?>

<?php if(session('success')): ?> <div class="toast ok"><?php echo e(session('success')); ?></div> <?php endif; ?>
<?php if(session('error')): ?>   <div class="toast bad"><?php echo e(session('error')); ?></div> <?php endif; ?>

<section class="glass hello">
    <p class="eyebrow"><?php echo e(now()->format('l, F j')); ?></p>
    <h1><?php echo e($hello); ?>, <?php echo e(\Illuminate\Support\Str::before(auth()->user()->name, ' ')); ?>.</h1>
</section>

<section class="stats">
    <div class="glass stat"><b><?php echo e($stats['patients']); ?></b><span>Patients</span></div>
    <div class="glass stat"><b><?php echo e($stats['doctors']); ?></b><span>Doctors</span></div>
    <div class="glass stat"><b><?php echo e($stats['today']); ?></b><span>Appointments today</span></div>
    <div class="glass stat"><b><?php echo e($stats['consultations']); ?></b><span>Consultations</span></div>
</section>

<div class="grid">
    <div class="col">
        <section class="glass panel">
            <h2>Upcoming appointments</h2>
            <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="row">
                    <div class="when"><?php echo e(\Carbon\Carbon::parse($a->appointment_date)->format('M j')); ?><small><?php echo e(\Carbon\Carbon::parse($a->appointment_time)->format('g:i A')); ?></small></div>
                    <div class="grow"><b><?php echo e($a->patient->name); ?></b><small>with Dr. <?php echo e($a->doctor->name); ?> · <?php echo e($a->doctor->specialization); ?></small></div>
                    <span class="pill"><?php echo e($a->status); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p class="empty">Nothing scheduled yet.</p> <?php endif; ?>
        </section>

        <section class="glass panel">
            <h2>Recent patients</h2>
            <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="row">
                    <div class="grow"><b><?php echo e($p->name); ?></b><small><?php echo e($p->age); ?> · <?php echo e($p->gender); ?> · <?php echo e($p->contact_number); ?></small></div>
                    <span class="pill soft"><?php echo e($p->patientRecord?->blood_type ?? '—'); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p class="empty">No patients yet.</p> <?php endif; ?>
        </section>

        <section class="glass panel">
            <h2>Latest consultations</h2>
            <?php $__empty_1 = true; $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="row">
                    <div class="grow"><b><?php echo e($c->patient->name); ?></b><small><?php echo e($c->diagnosis ?: 'No diagnosis noted'); ?> · Dr. <?php echo e($c->doctor->name); ?></small></div>
                    <small><?php echo e(\Carbon\Carbon::parse($c->consultation_date)->format('M j')); ?></small>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p class="empty">No consultations yet.</p> <?php endif; ?>
        </section>
    </div>

    <aside class="glass panel add" data-open="<?php echo e($open); ?>">
        <h2>Quick add</h2>
        <div class="tabs">
            <button type="button" data-tab="patient">Patient</button>
            <button type="button" data-tab="doctor">Doctor</button>
            <button type="button" data-tab="appointment">Appointment</button>
            <button type="button" data-tab="consultation">Consult</button>
        </div>

        <?php if($errors->any()): ?>
            <div class="notice warn"><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
        <?php endif; ?>

        
        <form class="pane" data-pane="patient" method="POST" action="<?php echo e(route('patients.store')); ?>">
            <?php echo csrf_field(); ?> <?php if (isset($component)) { $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $component; } ?>
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
<?php endif; ?> <input type="hidden" name="_form" value="patient">
            <label>Name <input name="name" value="<?php echo e(old('_form') === 'patient' ? old('name') : ''); ?>"></label>
            <div class="two">
                <label>Age <input type="number" name="age" min="0" value="<?php echo e(old('_form') === 'patient' ? old('age') : ''); ?>"></label>
                <label>Gender <select name="gender"><option>Male</option><option>Female</option><option>Other</option></select></label>
            </div>
            <label>Contact number <input name="contact_number" value="<?php echo e(old('_form') === 'patient' ? old('contact_number') : ''); ?>"></label>
            <label>Address <textarea name="address" rows="2"><?php echo e(old('_form') === 'patient' ? old('address') : ''); ?></textarea></label>
            <label>Blood type <input name="blood_type" placeholder="e.g. O+"></label>
            <label>Allergies <textarea name="allergies" rows="2"></textarea></label>
            <label>Medical history <textarea name="medical_history" rows="2"></textarea></label>
            <button class="btn block" type="submit">Save patient</button>
        </form>

        
        <form class="pane" data-pane="doctor" method="POST" action="<?php echo e(route('doctors.store')); ?>">
            <?php echo csrf_field(); ?> <?php if (isset($component)) { $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $component; } ?>
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
<?php endif; ?> <input type="hidden" name="_form" value="doctor">
            <label>Name <input name="name" value="<?php echo e(old('_form') === 'doctor' ? old('name') : ''); ?>"></label>
            <label>Specialization <input name="specialization" value="<?php echo e(old('_form') === 'doctor' ? old('specialization') : ''); ?>"></label>
            <label>Contact number <input name="contact_number" value="<?php echo e(old('_form') === 'doctor' ? old('contact_number') : ''); ?>"></label>
            <label>Email <input type="email" name="email" value="<?php echo e(old('_form') === 'doctor' ? old('email') : ''); ?>"></label>
            <button class="btn block" type="submit">Save doctor</button>
        </form>

        
        <form class="pane" data-pane="appointment" method="POST" action="<?php echo e(route('appointments.store')); ?>">
            <?php echo csrf_field(); ?> <?php if (isset($component)) { $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $component; } ?>
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
<?php endif; ?> <input type="hidden" name="_form" value="appointment">
            <label>Patient <select name="patient_id"><?php $__currentLoopData = $allPatients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($p->id); ?>" <?php if(old('patient_id') == $p->id): echo 'selected'; endif; ?>><?php echo e($p->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
            <label>Doctor <select name="doctor_id"><?php $__currentLoopData = $allDoctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($d->id); ?>" <?php if(old('doctor_id') == $d->id): echo 'selected'; endif; ?>>Dr. <?php echo e($d->name); ?> — <?php echo e($d->specialization); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
            <div class="two">
                <label>Date <input type="date" name="appointment_date" min="<?php echo e(today()->toDateString()); ?>" value="<?php echo e(old('appointment_date')); ?>"></label>
                <label>Time <input type="time" name="appointment_time" value="<?php echo e(old('appointment_time')); ?>"></label>
            </div>
            <label>Reason <textarea name="reason" rows="2"><?php echo e(old('reason')); ?></textarea></label>
            <button class="btn block" type="submit">Book appointment</button>
        </form>

        
        <form class="pane" data-pane="consultation" method="POST" action="<?php echo e(route('consultations.store')); ?>">
            <?php echo csrf_field(); ?> <?php if (isset($component)) { $__componentOriginalae8554ecbfd667a0d86b9c0e4411a6a0 = $component; } ?>
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
<?php endif; ?> <input type="hidden" name="_form" value="consultation">
            <label>Patient <select name="patient_id"><?php $__currentLoopData = $allPatients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
            <label>Doctor <select name="doctor_id"><?php $__currentLoopData = $allDoctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($d->id); ?>">Dr. <?php echo e($d->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
            <label>Date <input type="date" name="consultation_date" max="<?php echo e(today()->toDateString()); ?>" value="<?php echo e(today()->toDateString()); ?>"></label>
            <label>Diagnosis <textarea name="diagnosis" rows="2"></textarea></label>
            <label>Treatment <textarea name="treatment" rows="2"></textarea></label>
            <button class="btn block" type="submit">Save consultation</button>
        </form>
    </aside>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LaravelProjects\Hospital-Management\resources\views/dashboard.blade.php ENDPATH**/ ?>