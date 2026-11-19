@props(['id', 'judul', 'penulis', 'tahun'])

<div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <h3 style="margin-top: 0; margin-bottom: 8px; font-size: 1.1em; font-weight: bold; color: #111;">{{ $judul }}</h3>
    <p style="margin: 4px 0; color: #4b5563;">Penulis: {{ $penulis }}</p>
    <p style="margin: 4px 0 12px 0; color: #4b5563;">Tahun: {{ $tahun }}</p>
    
    <a href="{{ route('buku.detail', $id) }}" style="display: inline-block; background-color: #3b82f6; color: white; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 0.9em; font-weight: 500;">
        Detail
    </a>
</div>