

<?php $__env->startSection('content'); ?>
<div class="page-heading">
    <h2>Detail Peminjaman #<?php echo e($peminjaman->id); ?></h2>
</div>

<section class="panel">
    <p><strong>Nama Peminjam:</strong> <?php echo e($peminjaman->anggota->nama ?? '-'); ?></p>
    <p><strong>Email Peminjam:</strong> <?php echo e($peminjaman->anggota->email ?? '-'); ?></p>
    <p><strong>Judul Buku:</strong> <?php echo e($peminjaman->buku->judul ?? '-'); ?></p>
    <p><strong>Tanggal Pinjam:</strong> <?php echo e($peminjaman->tanggal_pinjam); ?></p>
    <p><strong>Tanggal Kembali:</strong> <?php echo e($peminjaman->tanggal_kembali ?? 'Belum dikembalikan'); ?></p>

    <div class="form-actions" style="margin-top: 1rem;">
        <a href="<?php echo e(route('riwayat')); ?>" class="btn btn-secondary">Kembali ke Riwayat</a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum_Modul6\resources\views/peminjaman/show.blade.php ENDPATH**/ ?>