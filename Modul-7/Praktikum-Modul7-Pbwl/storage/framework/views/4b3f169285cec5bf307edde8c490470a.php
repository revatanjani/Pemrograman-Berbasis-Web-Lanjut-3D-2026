<?php $__env->startSection('content'); ?>
<meta name="can-manage-books" content="<?php echo e(auth()->user()->can('kelola data buku') ? '1' : '0'); ?>">
<meta name="can-borrow-books" content="<?php echo e(auth()->user()->can('mengajukan peminjaman buku') ? '1' : '0'); ?>">
<meta name="borrow-url" content="<?php echo e(route('peminjaman.store')); ?>">
<div class="page-heading">
    <h2>Daftar Buku</h2>
</div>

<div id="pesan" class="pesan" role="status" aria-live="polite" hidden></div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kelola data buku')): ?>
<section class="panel">
    <h3 id="judul-form">Tambah Buku</h3>
    <form id="form-buku">
        <input type="hidden" id="buku-id">

        <div class="form-grid">
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select id="kategori_id" required>
                    <option value="">Pilih kategori</option>
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text" id="judul" minlength="3" maxlength="150" required>
            </div>

            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" id="penulis" minlength="3" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number" id="tahun_terbit" min="1900" max="<?php echo e(date('Y')); ?>" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan Buku</button>
            <button type="button" class="btn btn-secondary" id="btn-batal" hidden>Batal Ubah</button>
        </div>
    </form>
</section>
<?php endif; ?>

<section class="panel">
    <div class="table-heading">
        <h3>Data Buku</h3>
        <button type="button" class="btn btn-secondary" id="btn-muat">Muat Ulang</button>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <?php if(auth()->user()->can('kelola data buku') || auth()->user()->can('mengajukan peminjaman buku')): ?><th>Aksi</th><?php endif; ?>
                </tr>
            </thead>
            <tbody id="daftar-buku">
                <tr><td colspan="6">Memuat data buku...</td></tr>
            </tbody>
        </table>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/buku.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Praktikum-Modul7-Pbwl\resources\views/buku/index.blade.php ENDPATH**/ ?>