<?php

namespace App\Monuments\Contacts\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Monuments\Contacts\Models\Contact;
use App\Monuments\Contacts\Repositories\ContactRepository;
use App\Monuments\Contacts\Requests\ContactRequest;
Use RealRashid\SweetAlert\Facades\Alert;


class ContactController extends Controller
{

    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $contact = $this->repository->index();
        return view('admin.contact', compact('contact'));
    }

    public function store(ContactRequest $request)
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

    public function update(ContactRequest $request, $id)
    {
        try {
            $this->repository->update($request->toDto(),$id);
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
