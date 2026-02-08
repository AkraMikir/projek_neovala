<div class="form-data-section">
    <div class="section-header">
        <h2>Form Data BSR</h2>
    </div>
    <div class="form-data-container">
        <div class="form-data-header">
            <div class="header-cell">Nama</div>
            <div class="header-cell">No HP</div>
            <div class="header-cell">Lama Sewa</div>
            <div class="header-cell">Ukuran Kamar</div>
            <div class="header-cell">Actions</div>
        </div>
        <div class="form-data-body">
            @if(count($formData) > 0)
                @foreach($formData as $data)
                <div class="form-data-row" data-id="{{ $data->id }}">
                    <div class="data-cell">{{ $data->nama }}</div>
                    <div class="data-cell">{{ $data->nomor_wa }}</div>
                    <div class="data-cell">{{ $data->durasi }}</div>
                    <div class="data-cell">{{ $data->tipe_kamar }}</div>
                    <div class="data-cell actions">
                        <button class="detail-btn" data-details="{{ json_encode($data) }}" onclick="openDetail(this)">Detail</button>
                        <form action="{{ route('admin.dashboard1.bsr.deleteFormData', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-btn-data" onclick="confirmDelete(this.form)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <div class="form-data-row">
                    <div class="data-cell" colspan="5">Tidak ada data</div>
                </div>
            @endif
        </div>
        <div class="form-data-pagination">
            {{ $formData->links('admin.pagination.custom') }}
        </div>
    </div>
</div>
