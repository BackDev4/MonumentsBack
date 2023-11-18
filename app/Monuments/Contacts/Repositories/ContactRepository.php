<?php

namespace App\Monuments\Contacts\Repositories;

use App\Monuments\Contacts\DTOs\ContactDTO;
use App\Monuments\Contacts\Interface\ContactInterface;
use App\Monuments\Contacts\Models\Contact;

class ContactRepository implements ContactInterface
{

    public function index()
    {
        return Contact::all();
    }

    public function create(ContactDTO $DTO)
    {
        $contact = new Contact();
        $contact->fill([
            'phone' => $DTO->phone
        ]);
        $contact->save();
    }

    public function show($id)
    {
        return Contact::find($id);
    }

    public function update(ContactDTO $DTO, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->phone = $DTO->phone;
        $contact->save();
    }

    public function delete($id)
    {
        return Contact::destroy($id);
    }
}
