<div class="edit-room-section" id="editRoomSection" style="display: none;">
    <div class="header-admin">
        <header>
            <h1>Edit Room Transpark Cibubur</h1>
        </header>
    </div>

    <form action="" method="POST" id="editRoomForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="room_section" value="room_transpark_cibubur">
        <input type="hidden" name="room_id" id="editRoomId">

        <div class="room-form-container">
            <!-- Main Room Image -->
            <div class="room-main-image">
                <div class="image-upload-large" onclick="document.getElementById('editMainFile').click()">
                    <i class="fas fa-image" id="editMainIcon"></i>
                    <p id="editMainText">Insert Room Main Photo</p>
                    <img id="editMainPreview" src="" alt="Main Room Photo" class="preview-image" style="display: none;">
                    <input type="file" name="main_photo" id="editMainFile" class="room-photo-input" accept="image/*" hidden onchange="previewImage(this, 'editMainPreview')">
                </div>
            </div>

            <!-- Additional Room Photos -->
            <div class="room-additional-images">
                @for ($i = 1; $i <= 4; $i++)
                <div class="image-upload-small" onclick="document.getElementById('editPopupFile{{ $i }}').click()">
                    <i class="fas fa-image" id="editPopupIcon{{ $i }}"></i>
                    <p id="editPopupText{{ $i }}">Insert Room Photo</p>
                    <img id="editPopupPreview{{ $i }}" class="preview-image" src="" alt="Room Additional {{ $i }}" style="display: none;">
                    <input type="file" name="popup{{ $i }}" id="editPopupFile{{ $i }}" class="room-photo-input" accept="image/*" hidden onchange="previewImage(this, 'editPopupPreview{{ $i }}')">
                </div>
                @endfor
            </div>

            <!-- Action Buttons -->
            <div class="back-button-container">
                <button type="button" class="back-btn" onclick="hideEditRoom()">Back</button>
                <button type="submit" class="update-btn">Update</button>
            </div>
        </div>
    </form>
</div>
