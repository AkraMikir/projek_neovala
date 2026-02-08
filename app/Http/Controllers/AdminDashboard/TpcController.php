<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Carousel;
use App\Models\KomentarTpc;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class TpcController extends Controller
{
    protected $section = 'TPC';
    protected $apartmentName = 'Transpark Cibubur';
    protected $roomSection = 'room_transpark_cibubur';
    protected $commentModel = KomentarTpc::class;
    protected $apartmentCode = 'tpc';
    protected $commentSection = 'tpc';
    
    public function index()
    {
        $carousel = Carousel::where('section', $this->section)->first();
        $carouselImages = [
            1 => $carousel->image1 ?? null,
            2 => $carousel->image2 ?? null,
            3 => $carousel->image3 ?? null,
            4 => $carousel->image4 ?? null,
        ];
        
        $rooms = Room::where('section', $this->roomSection)->latest()->paginate(6, ['*'], 'rooms_page')->through(function($room) {
            return [
                'id' => $room->id,
                'section' => $room->section,
                'main_photo' => asset('storage/' . $room->main_photo),
                'popup_photos' => [
                    $room->popup1 ? asset('storage/' . $room->popup1) : null,
                    $room->popup2 ? asset('storage/' . $room->popup2) : null,
                    $room->popup3 ? asset('storage/' . $room->popup3) : null,
                    $room->popup4 ? asset('storage/' . $room->popup4) : null,
                ],
                'room_name' => 'Room ' . $room->id,
            ];
        });
        
        $comments = $this->commentModel::where('section', $this->commentSection)->latest()->paginate(9, ['*'], 'comments_page');
        $formData = FormData::where('apartment_type', 'like', '%' . $this->apartmentName . '%')->latest()->paginate(10);
        
        return view('admin.apartments.' . $this->apartmentCode . '.index', [
            'carouselImages' => $carouselImages,
            'rooms' => $rooms,
            'comments' => $comments,
            'formData' => $formData,
            'section' => $this->section,
            'apartmentName' => $this->apartmentName,
            'apartmentCode' => $this->apartmentCode
        ]);
    }
    
    public function updateCarousel(Request $request)
    {
        $validated = $request->validate(['images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120']);
        $carousel = Carousel::firstOrCreate(['section' => $this->section]);
        
        foreach ([1, 2, 3, 4] as $index) {
            if ($request->hasFile("images.$index")) {
                $oldImage = "image$index";
                if ($carousel->$oldImage && Storage::disk('public')->exists($carousel->$oldImage)) {
                    Storage::disk('public')->delete($carousel->$oldImage);
                }
                
                $image = $request->file("images.$index");
                $filename = ImageService::upload(
                    $image,
                    'carousel/' . strtolower($this->section),
                    1920, 85,
                    $this->section . '_slide' . $index
                );
                
                $carousel->{"image$index"} = 'carousel/' . strtolower($this->section) . '/' . $filename;
            }
        }
        
        $carousel->save();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Carousel updated successfully!');
    }
    
    public function storeRoom(Request $request)
    {
        $validated = $request->validate([
            'main_photo' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'popup1' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup2' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup3' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup4' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);
        
        $section = $this->roomSection;

        // Calculate New Folder
        $latestFolder = collect(Storage::disk('public')->directories("rooms/$section"))
            ->map(fn($f) => (int) basename($f))->filter()->max() ?? 0;

        $newFolder = $latestFolder + 1;

        $paths = [];
        // Handle main_photo
        if ($request->hasFile('main_photo')) {
            $filename = ImageService::upload(
                $request->file('main_photo'),
                "rooms/$section/$newFolder",
                1200, 80, 'main_photo'
            );
            $paths['main_photo'] = "rooms/$section/$newFolder/$filename";
        } else {
            $paths['main_photo'] = null;
        }

        // Handle popups
        foreach (['popup1', 'popup2', 'popup3', 'popup4'] as $field) {
            if ($request->hasFile($field)) {
                $filename = ImageService::upload(
                    $request->file($field),
                    "rooms/$section/$newFolder",
                    1200, 80, $field
                );
                $paths[$field] = "rooms/$section/$newFolder/$filename";
            } else {
                $paths[$field] = null;
            }
        }
        
        Room::create([
            'section' => $section,
            'folder' => $newFolder,
            'main_photo' => $paths['main_photo'],
            'popup1' => $paths['popup1'],
            'popup2' => $paths['popup2'],
            'popup3' => $paths['popup3'],
            'popup4' => $paths['popup4'],
        ]);

        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Room created successfully!');
    }
    
    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $validated = $request->validate([
            'main_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup1' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup2' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup3' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'popup4' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);
        
        $section = $this->roomSection;
        $folder = $room->folder ?? '1';

        foreach (['main_photo', 'popup1', 'popup2', 'popup3', 'popup4'] as $field) {
            if ($request->hasFile($field)) {
                if ($room->$field && Storage::disk('public')->exists($room->$field)) {
                    Storage::disk('public')->delete($room->$field);
                }
                
                $image = $request->file($field);
                $filename = ImageService::upload(
                    $image,
                    "rooms/$section/$folder",
                    1200, 80,
                    $field
                );
                $room->$field = "rooms/$section/$folder/$filename";
            }
        }
        
        $room->save();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Room updated successfully!');
    }
    
    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        foreach (['main_photo', 'popup1', 'popup2', 'popup3', 'popup4'] as $field) {
            if ($room->$field && Storage::disk('public')->exists($room->$field)) {
                Storage::disk('public')->delete($room->$field);
            }
        }
        $room->delete();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Room deleted successfully!');
    }
    
    public function applyComment($id)
    {
        $comment = $this->commentModel::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Comment approved!');
    }
    
    public function unapplyComment($id)
    {
        $comment = $this->commentModel::findOrFail($id);
        $comment->status = 'pending';
        $comment->save();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Comment set to pending!');
    }
    
    public function deleteComment($id)
    {
        $comment = $this->commentModel::findOrFail($id);
        $comment->delete();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Comment deleted!');
    }
    
    public function viewFormDetail($id)
    {
        $data = FormData::findOrFail($id);
        return response()->json($data);
    }
    
    public function deleteFormData($id)
    {
        $data = FormData::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.dashboard1.' . $this->apartmentCode)->with('success', 'Form data deleted!');
    }
}
