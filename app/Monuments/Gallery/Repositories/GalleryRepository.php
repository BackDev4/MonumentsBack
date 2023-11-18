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
        $contact = new Gallery();
        $imagePath = $DTO->image->store('gallery', 'public');
        $contact->fill([
            'title' => $DTO->title,
            'image' => $imagePath,
        ]);
        $contact->save();
    }

    public function show($id)
    {
        return Gallery::find($id);
    }

    public function update(GalleryDTO $DTO, $id)
    {
        $contact = Gallery::find($id);
        $contact->title = $DTO->title;
        $contact->image = $DTO->image;
        $contact->save();
    }

    public function delete($id)
    {
        return Gallery::destroy($id);
    }
}
