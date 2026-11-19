<?php $__env->startSection('content'); ?>
<div class="panel">
<h2>Dashboard Petugas</h2>
<p>Selamat datang, <?php echo e(auth()->user()->name); ?>. Kamu dapat mengelola buku dan kegiatan peminjaman perpustakaan.</p>
<a href="<?php echo e(route('buku.index')); ?>">Kelola data buku</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum_Modul6\resources\views/dashboard/petugas.blade.php ENDPATH**/ ?>