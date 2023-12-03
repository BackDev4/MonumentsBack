<?php

namespace App\Monuments\Services\Repositories;

use App\Monuments\Services\DTOs\ServicesDTO;
use App\Monuments\Services\Interface\ServicesInterface;
use App\Monuments\Services\Models\Services;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ServicesRepository implements ServicesInterface
{


    public function index()
    {
        return Services::paginate(9);
    }

    public function create(ServicesDTO $DTO)
    {
        $imagePath = $this->uploadPhoto(request('image'));
        $services = new Services();
        $services->fill([
            'title' => $DTO->title,
            'content' => $DTO->content,
            'image' => $imagePath,
        ]);
        $services->save();
    }

    public function show($id)
    {
        return Services::find($id);
    }

    public function update(ServicesDTO $DTO, $id)
    {
        Services::where('id', $id)->update([
            'title' => $DTO->title,
            'content' => $DTO->content,
            'updated_at' => now(),
        ]);
    }

    public function delete($id)
    {
        return Services::destroy($id);
    }

    private function uploadPhoto($image)
    {
        $filename =  uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = asset('/storage/' . $image->storeAs('services', $filename, 'public'));

        return $imagePath;
    }

}
