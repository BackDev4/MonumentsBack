<?php

namespace App\Monuments\Gallery\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Monuments\Gallery\Requests\GalleryRequest;
use App\Monuments\Gallery\Models\Gallery;
use App\Monuments\Gallery\Repositories\GalleryRepository;
Use RealRashid\SweetAlert\Facades\Alert;


class GalleryController extends Controller
{

    private GalleryRepository $repository;

    public function __construct(GalleryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $gallery = $this->repository->index();
        return view('admin.gallery', compact('gallery'));
    }

    public function store(GalleryRequest $request)
    {
        try {
            $this->repository->create($request->toDto());
            alert()->success('Success', 'Успешно добавлено');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Error', 'Произошла ошибка: ' . $th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }

    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(GalleryRequest $request, $id)
    {
        try {
            $gallery = Gallery::find($id);
            $this->repository->update($request->toDto(),$gallery);
            alert()->success('Success', 'Успешно обновлено');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Error', 'Произошла ошибка: ' . $th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
            alert()->success('Success', 'Успешно удалено');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Error', 'Произошла ошибка: ' . $th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }
    }

}
