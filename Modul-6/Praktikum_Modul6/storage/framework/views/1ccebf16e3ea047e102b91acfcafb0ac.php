<?php $__env->startSection('content'); ?>
<div class="panel">
    <h2>Riwayat Peminjaman</h2>

    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'siswa')): ?>
        <p>Berikut daftar buku yang pernah kamu pinjam.</p>
    <?php else: ?>
        <p>Admin dan Petugas dapat mengelola seluruh riwayat peminjaman.</p>
    <?php endif; ?>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <?php if(auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku')): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->anggota->nama ?? '-'); ?></td>
                        <td><?php echo e($item->buku->judul ?? '-'); ?></td>
                        <td><?php echo e($item->tanggal_pinjam ? \Illuminate\Support\Carbon::parse($item->tanggal_pinjam)->format('Y-m-d') : '-'); ?></td>
                        <td><?php echo e($item->tanggal_kembali ? \Illuminate\Support\Carbon::parse($item->tanggal_kembali)->format('Y-m-d') : '-'); ?></td>

                        <?php if(auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku')): ?>
                            <td class="aksi">
                                <?php if(auth()->user()->can('mencatat pengembalian buku') && !$item->tanggal_kembali): ?>
                                    <form method="POST" action="<?php echo e(route('peminjaman.kembalikan', $item)); ?>" style="display:inline" onsubmit="return confirm('Catat buku ini sudah dikembalikan?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="btn btn-primary">Tandai Dikembalikan</button>
                                    </form>
                                <?php elseif($item->tanggal_kembali): ?>
                                    <span>Sudah Dikembalikan</span>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kelola peminjaman')): ?>
                                    <form method="POST" action="<?php echo e(route('peminjaman.destroy', $item)); ?>" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus riwayat peminjaman ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-delete">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku') ? 5 : 4); ?>">
                            Belum ada riwayat peminjaman.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum_Modul6\resources\views/peminjaman/riwayat.blade.php ENDPATH**/ ?>