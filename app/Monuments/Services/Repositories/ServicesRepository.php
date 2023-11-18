<?php

namespace App\Monuments\Services\Repositories;

use App\Monuments\Services\DTOs\ServicesDTO;
use App\Monuments\Services\Interface\ServicesInterface;
use App\Monuments\Services\Models\Services;

class ServicesRepository implements ServicesInterface
{


    public function index()
    {
        return Services::paginate(9);
    }

    public function create(ServicesDTO $DTO)
    {
        $services = new Services();
        $services->fill([
            'title' => $DTO->title,
            'content' => $DTO->content,
        ]);
        $services->save();
    }

    public function show($id)
    {
        return Services::find($id);
    }

    public function update(ServicesDTO $DTO,$id)
    {
        $services = Services::find($id);
        $services->phone = $DTO->phone;
        $services->save();
    }

    public function delete($id)
    {
        return Services::destroy($id);
    }
}
