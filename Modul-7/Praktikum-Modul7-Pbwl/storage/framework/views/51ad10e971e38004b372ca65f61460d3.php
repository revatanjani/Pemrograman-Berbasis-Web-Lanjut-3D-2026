<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="panel auth-box">
    <h2>Login Ambabook - 250441100068</h2>
    <form method="POST" action="<?php echo e(route('login.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
        <div class="form-actions"><button class="btn btn-primary">Login</button></div>
    </form>
    <p>Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>.</p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum-Modul7-Pbwl\resources\views/auth/login.blade.php ENDPATH**/ ?>