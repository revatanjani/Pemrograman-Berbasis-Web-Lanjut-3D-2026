<?php $__env->startSection('content'); ?>
<div class="panel">
<h2>Dashboard Siswa</h2>
<p>Selamat datang, <?php echo e(auth()->user()->name); ?>.</p>
<p><a href="<?php echo e(route('buku.index')); ?>">Lihat daftar buku</a> · <a href="<?php echo e(route('profile.edit')); ?>">Perbarui profil</a> · <a href="<?php echo e(route('riwayat')); ?>">Riwayat peminjaman saya</a></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\belajar_laravel_modul5\resources\views/dashboard/siswa.blade.php ENDPATH**/ ?>