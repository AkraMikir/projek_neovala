<div class="create-room-section" id="createRoomSection" style="display: none;">
    <div class="header-admin">
        <header>
            <h1>Buat Room Grand Kamala Lagoon</h1>
        </header>
    </div>

    <form action="{{ route('admin.dashboard1.gkl.storeRoom') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="room_section" value="room_grand_kamala_lagoon">

        <div class="room-form-container">
            <!-- Main Image -->
            <div class="room-main-image">
                <div class="image-upload-large" onclick="document.getElementById('createMainFile').click()">
                    <i class="fas fa-image"></i>
                    <p>Insert room main photo</p>
                    <img id="createMainPreview" src="" alt="Main Preview" class="preview-image" style="display: none;">
                    <input type="file" name="main_photo" id="createMainFile" class="room-photo-input" accept="image/*" hidden required onchange="previewImage(this, 'createMainPreview')">
                </div>
            </div>

            <!-- Additional Images -->
            <div class="room-additional-images">
                @for($i = 1; $i <= 4; $i++)
                <div class="image-upload-small" onclick="document.getElementById('createPopupFile{{ $i }}').click()">
                    <i class="fas fa-image"></i>
                    <p>Insert room photo</p>
                    <img id="createPopupPreview{{ $i }}" src="" alt="Popup Preview {{ $i }}" class="preview-image" style="display: none;">
                    <input type="file" name="popup{{ $i }}" id="createPopupFile{{ $i }}" class="room-photo-input" accept="image/*" hidden onchange="previewImage(this, 'createPopupPreview{{ $i }}')">
                </div>
                @endfor
            </div>

            <!-- Buttons -->
            <div class="back-button-container">
                <button type="button" class="create-back-btn" onclick="hideCreateRoom()">Back</button>
                <button type="submit" class="create-save-btn">Buat</button>
            </div>
        </div>
    </form>
</div>
