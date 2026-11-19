<?php $__env->startSection('content'); ?>
<div class="panel">
<h2>Dashboard Admin</h2>
<p>Selamat datang, <?php echo e(auth()->user()->name); ?>. Kamu memiliki akses administrasi penuh.</p>
<ul>
<li><a href="<?php echo e(route('buku.index')); ?>">Kelola data buku</a></li>
<li><a href="<?php echo e(route('admin.pengguna')); ?>">Kelola akun dan role pengguna</a></li>
</ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum-Modul7-Pbwl\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>