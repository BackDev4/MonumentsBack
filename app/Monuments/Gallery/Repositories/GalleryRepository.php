<?php

namespace App\Monuments\Gallery\Repositories;


use App\Monuments\Gallery\DTOs\GalleryDTO;
use App\Monuments\Gallery\Interface\GalleryInterface;
use App\Monuments\Gallery\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryRepository implements GalleryInterface
{

    public function index()
    {
        return Gallery::paginate(10);
    }

    public function create(GalleryDTO $DTO)
    {
        $imagePath = $this->uploadPhoto(request('image'));
        $gallery = new Gallery();
        $gallery->fill([
            'title' => $DTO->title,
            'image' => $imagePath,
        ]);
        $gallery->save();
    }

    public function show($id)
    {
        return Gallery::find($id);
    }

    public function update(GalleryDTO $DTO, $id)
    {
        if (request('file')) {
            $imagePath = $this->uploadPhoto(request('file'));
        }
        Gallery::where('id', $id)->update([
            'title' => $DTO->title,
            'image' => $imagePath,
            'updated_at' => now(),
        ]);
    }

    public function delete($id)
    {
        return Gallery::destroy($id);
    }

    private function uploadPhoto($image)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = asset('/storage/' . $image->storeAs('gallery', $filename, 'public'));

        return $imagePath;
    }
}
