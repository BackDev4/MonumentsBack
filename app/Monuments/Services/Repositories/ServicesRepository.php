<?php

namespace App\Monuments\Services\Repositories;

use App\Monuments\Services\DTOs\ServicesDTO;
use App\Monuments\Services\Interface\ServicesInterface;
use App\Monuments\Services\Models\Services;

class ServicesRepository implements ServicesInterface
{

    public function index()
    {
        $perPage = 6;
        $page = request('page', 1);
        return Services::paginate($perPage, ['*'], 'page', $page);
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
        $service = Services::find($id)->first();

        if (request('file')) {
            $imagePath = $this->uploadPhoto(request('file'));
            $service->image = $imagePath;
        }

        $service->title = $DTO->title;
        $service->content = $DTO->content;
        $service->save();
        return response()->json($service);
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
