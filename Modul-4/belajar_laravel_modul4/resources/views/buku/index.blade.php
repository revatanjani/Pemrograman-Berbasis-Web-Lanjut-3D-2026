@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h2>Daftar Buku</h2>
</div>

<div id="pesan" class="pesan" role="status" aria-live="polite" hidden></div>

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
                <input type="number" id="tahun_terbit" min="1900" max="{{ date('Y') }}" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan Buku</button>
            <button type="button" class="btn btn-secondary" id="btn-batal" hidden>Batal Ubah</button>
        </div>
    </form>
</section>

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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="daftar-buku">
                <tr><td colspan="6">Memuat data buku...</td></tr>
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/buku.js') }}"></script>
@endpush
