<?php

namespace App\Monuments\Contacts\Controllers;

use App\Http\Controllers\Controller;
use App\Monuments\Contacts\Repositories\ContactRepository;

class ContactController extends Controller
{

    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }
}
