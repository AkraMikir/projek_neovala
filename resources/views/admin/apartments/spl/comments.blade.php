<div class="comment-section">
    <div class="section-header">
        <h2>All SPL Comment</h2>
    </div>
    
    <div class="comment-cards">
        @if(count($comments) > 0)
            @foreach($comments as $komen)
            <div class="comment-card">
                <div class="comment-header tpj-quote-wrapper">
                    <span class="tpj-quote-icon">"</span>
                </div>
                <div class="comment-content">
                    <p class="tpj-comment-text">{{ $komen->message }}</p>
                </div>
                <div class="comment-footer">
                    <div class="comment-info">
                        <span class="tpj-comment-user">
                            {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                        </span>
                        <div class="tpj-star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="comment-actions">
                        @if ($komen->status === 'pending')
                            <form action="{{ route('admin.dashboard1.spl.applyComment', $komen->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="apply-btn">Apply</button>
                            </form>
                        @else
                            <form action="{{ route('admin.dashboard1.spl.unapplyComment', $komen->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="unapply-btn">Unapply</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.dashboard1.spl.deleteComment', $komen->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-btn" onclick="confirmDelete(this.form)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="no-data">
                <p>Belum ada komentar</p>
            </div>
        @endif
    </div>

    <div class="form-data-pagination" style="background: transparent; border: none;">
        {{ $comments->appends(array_merge(request()->query(), ['tab' => 'comments']))->links('admin.pagination.custom') }}
    </div>
</div>
