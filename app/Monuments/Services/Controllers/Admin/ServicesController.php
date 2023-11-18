<?php

namespace App\Monuments\Services\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Monuments\Services\Models\Services;
use App\Monuments\Services\Repositories\ServicesRepository;
use App\Monuments\Services\Requests\ServicesRequest;

class ServicesController extends Controller
{

    private ServicesRepository $repository;

    public function __construct(ServicesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $services = $this->repository->index();
        return view('admin.services', compact('services'));
    }

    public function store(ServicesRequest $request)
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

    public function update(ServicesRequest $request, $id)
    {
        try {
            $contact = Services::find($id);
            $this->repository->update($request->toDto(), $contact);
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
