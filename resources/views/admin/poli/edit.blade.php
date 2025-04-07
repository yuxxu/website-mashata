@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Poli</h2>

    <form action="{{ route('poli.update', $poli->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_poli" class="form-label">Nama Poli</label>
            <input type="text" class="form-control" name="nama_poli" value="{{ $poli->nama_poli }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="3">{{ $poli->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Poli</label>
            @if($poli->image)
                <img src="{{ asset('storage/' . $poli->image) }}" class="img-thumbnail mb-2" width="150">
            @endif
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
