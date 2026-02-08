    <div class="section-header">
        <h2>Showing Apartemen Room</h2>
        <button class="add-room-btn" onclick="showCreateRoom()">
            + ROOM
        </button>
    </div>
    <div class="room-cards">
        @foreach ($rooms as $room)
        <!-- Room Card -->
        <div class="room-card">
            <div class="room-card-header">
                <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                <div class="right-text">TRANSPARK <span class="room-type">PODOMORO</span></div>
            </div>
            <div class="room-card-image">
                <img src="{{ $room['main_photo'] ?: asset('img/default-room.png') }}"
                     alt="Room {{ $room['room_name'] }}">
            </div>
            <div class="room-action-buttons">
                <!-- Data attributes for edit -->
                <button class="edit-room-btn" 
                        data-room="{{ json_encode($room) }}" 
                        data-update-url="{{ route('admin.dashboard1.pgv.updateRoom', $room['id']) }}"
                        onclick="openEditRoom(this)">
                    <i class="fas fa-edit"></i>
                </button>
                
                <button class="more-btn" onclick="showRoomPopup('roomPopup{{ $room['id'] }}')">MORE</button>
                
                <form action="{{ route('admin.dashboard1.pgv.deleteRoom', $room['id']) }}" method="POST" class="d-inline" onsubmit="event.preventDefault(); confirmDelete(this);">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-room-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Popup Room -->
        <div class="room-popup-overlay" id="roomPopup{{ $room['id'] }}" style="display: none;">
            <div class="room-popup-container">
                <button class="room-popup-close" onclick="closeRoomPopup('roomPopup{{ $room['id'] }}')">
                    <i class="fas fa-times"></i>
                </button>
                <div class="room-popup-carousel">
                    <div class="room-popup-carousel-container">
                        <!-- Main Photo -->
                         <div class="room-popup-slide active">
                            <img src="{{ $room['main_photo'] ?: asset('img/default-room.png') }}" 
                                 alt="Room {{ $room['room_name'] }} Main">
                        </div>
                        <!-- Additional Photos -->
                        @if(!empty($room['popup_photos']))
                            @foreach ($room['popup_photos'] as $index => $popup)
                                @if($popup)
                                <div class="room-popup-slide">
                                    <img src="{{ $popup }}"
                                        alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <button class="room-popup-nav next" onclick="nextPopupSlide(this)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button class="room-popup-nav prev" onclick="prevPopupSlide(this)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="form-data-pagination" style="background: transparent; border: none;">
        {{ $rooms->appends(array_merge(request()->query(), ['tab' => 'rooms']))->links('admin.pagination.custom') }}
    </div>
