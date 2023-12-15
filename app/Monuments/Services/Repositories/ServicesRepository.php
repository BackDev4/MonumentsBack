<?php

namespace App\Monuments\Services\Repositories;

use App\Monuments\Services\DTOs\ServicesDTO;
use App\Monuments\Services\Interface\ServicesInterface;
use App\Monuments\Services\Models\Services;
use Carbon\Carbon;

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
        $service = Services::where('id',$id)->get();

        if (request()->hasFile('file')) {
            $imagePath = $this->uploadPhoto(request('file'));
            $service->image = $imagePath;
        }

        $service->title = $DTO->title;
        $service->content = $DTO->content;

        $service->save();
    }

    public function delete($id)
    {
        return Services::destroy($id);
    }

    private function uploadPhoto($image)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = asset('/storage/' . $image->storeAs('services', $filename, 'public'));

        return $imagePath;
    }

}
