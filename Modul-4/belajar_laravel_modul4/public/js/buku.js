const API_BUKU = '/api/buku';
const API_KATEGORI = '/api/kategori';

const formBuku = document.getElementById('form-buku');
const pesan = document.getElementById('pesan');
const daftarBuku = document.getElementById('daftar-buku');

function aman(teks) {
    return String(teks ?? '').replace(/[&<>"']/g, function (huruf) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        }[huruf];
    });
}

function tampilkanPesan(teks, jenis = 'success') {
    pesan.textContent = teks;
    pesan.className = 'pesan ' + jenis;
    pesan.hidden = false;
}

function sembunyikanPesan() {
    pesan.hidden = true;
    pesan.textContent = '';
}

async function requestAPI(url, pilihan = {}) {
    let response;

    try {
        response = await fetch(url, {
            ...pilihan,
            headers: {
                'Accept': 'application/json',
                ...(pilihan.body ? { 'Content-Type': 'application/json' } : {}),
                ...(pilihan.headers || {})
            }
        });
    } catch (error) {
        throw new Error('Tidak dapat terhubung ke API. Periksa apakah server Laravel berjalan.');
    }

    if (response.status === 204) {
        if (!response.ok) {
            throw new Error('Permintaan gagal.');
        }
        return null;
    }

    let hasil = null;

    try {
        hasil = await response.json();
    } catch (error) {
        // Respons mungkin tidak berisi JSON.
    }

    if (!response.ok) {
        if (response.status === 422 && hasil && hasil.errors) {
            const daftarError = Object.values(hasil.errors).flat().join(' ');
            throw new Error(daftarError || 'Data yang dimasukkan belum valid.');
        }

        throw new Error((hasil && hasil.message) || `Permintaan gagal dengan status ${response.status}.`);
    }

    return hasil;
}

async function muatKategori() {
    const hasil = await requestAPI(API_KATEGORI);
    const pilihan = document.getElementById('kategori_id');

    pilihan.innerHTML = '<option value="">Pilih kategori</option>';

    hasil.data.forEach(function (kategori) {
        pilihan.insertAdjacentHTML(
            'beforeend',
            `<option value="${kategori.id}">${aman(kategori.nama)}</option>`
        );
    });
}

async function muatBuku() {
    daftarBuku.innerHTML = '<tr><td colspan="6">Memuat data buku...</td></tr>';

    try {
        const hasil = await requestAPI(API_BUKU);
        const buku = hasil.data || [];

        if (buku.length === 0) {
            daftarBuku.innerHTML = '<tr><td colspan="6">Belum ada data buku.</td></tr>';
            return;
        }

        daftarBuku.innerHTML = buku.map(function (item, index) {
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td>${aman(item.kategori)}</td>
                    <td>${aman(item.judul)}</td>
                    <td>${aman(item.penulis)}</td>
                    <td>${aman(item.tahun_terbit)}</td>
                    <td class="aksi">
                        <button type="button" class="btn btn-edit" data-aksi="ubah" data-id="${item.id}">Ubah</button>
                        <button type="button" class="btn btn-delete" data-aksi="hapus" data-id="${item.id}">Hapus</button>
                    </td>
                </tr>
            `;
        }).join('');
    } catch (error) {
        daftarBuku.innerHTML = '<tr><td colspan="6">Data buku gagal dimuat.</td></tr>';
        tampilkanPesan(error.message, 'error');
    }
}

function resetForm() {
    formBuku.reset();
    document.getElementById('buku-id').value = '';
    document.getElementById('judul-form').textContent = 'Tambah Buku';
    document.getElementById('btn-simpan').textContent = 'Simpan Buku';
    document.getElementById('btn-batal').hidden = true;
}

formBuku.addEventListener('submit', async function (event) {
    event.preventDefault();
    sembunyikanPesan();

    const id = document.getElementById('buku-id').value;
    const dataBuku = {
        kategori_id: Number(document.getElementById('kategori_id').value),
        judul: document.getElementById('judul').value.trim(),
        penulis: document.getElementById('penulis').value.trim(),
        tahun_terbit: Number(document.getElementById('tahun_terbit').value)
    };

    try {
        await requestAPI(id ? `${API_BUKU}/${id}` : API_BUKU, {
            method: id ? 'PUT' : 'POST',
            body: JSON.stringify(dataBuku)
        });

        tampilkanPesan(id ? 'Data buku berhasil diubah.' : 'Buku berhasil ditambahkan.');
        resetForm();
        await muatBuku();
    } catch (error) {
        tampilkanPesan(error.message, 'error');
    }
});

daftarBuku.addEventListener('click', async function (event) {
    const tombol = event.target.closest('button[data-aksi]');

    if (!tombol) {
        return;
    }

    const id = tombol.dataset.id;
    sembunyikanPesan();

    if (tombol.dataset.aksi === 'ubah') {
        try {
            const hasil = await requestAPI(`${API_BUKU}/${id}`);
            const buku = hasil.data;

            document.getElementById('buku-id').value = buku.id;
            document.getElementById('kategori_id').value = buku.kategori_id;
            document.getElementById('judul').value = buku.judul;
            document.getElementById('penulis').value = buku.penulis;
            document.getElementById('tahun_terbit').value = buku.tahun_terbit;
            document.getElementById('judul-form').textContent = 'Ubah Buku';
            document.getElementById('btn-simpan').textContent = 'Simpan Perubahan';
            document.getElementById('btn-batal').hidden = false;
            formBuku.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (error) {
            tampilkanPesan(error.message, 'error');
        }

        return;
    }

    if (tombol.dataset.aksi === 'hapus') {
        const setuju = confirm('Apakah kamu yakin ingin menghapus buku ini?');

        if (!setuju) {
            return;
        }

        try {
            await requestAPI(`${API_BUKU}/${id}`, { method: 'DELETE' });
            tampilkanPesan('Buku berhasil dihapus.');
            await muatBuku();
        } catch (error) {
            tampilkanPesan(error.message, 'error');
        }
    }
});

document.getElementById('btn-batal').addEventListener('click', function () {
    resetForm();
    sembunyikanPesan();
});

document.getElementById('btn-muat').addEventListener('click', muatBuku);

async function mulai() {
    try {
        await muatKategori();
        await muatBuku();
    } catch (error) {
        daftarBuku.innerHTML = '<tr><td colspan="6">Data gagal dimuat.</td></tr>';
        tampilkanPesan(error.message, 'error');
    }
}

mulai();
