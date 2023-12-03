<?php

namespace App\Monuments\Reviews\Controllers\Admin;

use App\Monuments\Reviews\Models\Reviews;
use App\Monuments\Reviews\Repositories\ReviewsRepository;
use App\Monuments\Reviews\Requests\ReviewsRequest;

class ReviewsController
{
    private ReviewsRepository $repository;

    public function __construct(ReviewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $reviews = $this->repository->index();
        return view('admin.reviews', compact('reviews'));
    }

    public function store(ReviewsRequest $request)
    {
        try {
            $this->repository->store($request->toDto());
            alert()->success('Success', 'Успешно добавлено');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Error', 'Произошла ошибка: ' . $th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }

    }

    public function update(ReviewsRequest $request, $id)
    {
        try {
            $contact = Reviews::find($id);
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
