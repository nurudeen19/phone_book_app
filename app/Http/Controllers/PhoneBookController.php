<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $contacts = $this->getContacts($request);            
            //return message if no result found

            return response()->json(['contacts' => $contacts]);
        }
        return view('phonebook.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        PhoneBook::create($request->all());
        $contacts = $this->getContacts(request());
        return response()->json(['contacts' => $contacts, 'message' => 'Contact Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhoneBook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhoneBook $phonebook)
    {
        $phonebook->update($request->all());
        $contacts = $this->getContacts(request());
        return response()->json(['contacts' => $contacts,'message' => 'Contact Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneBook $phonebook)
    {
        $phonebook->delete();
        $contacts = $this->getContacts(request());
        return response()->json(['contacts' => $contacts,'message' => 'Contact Removed Successfully!']);
    }

    public function getContacts(Request $request){
        // check for the presence of request parameter
        $query = $request->get('query');
        if (isset($query)) {

            return PhoneBook::where("lname", "like", "%{$query}%")->get();
        }
        return PhoneBook::latest()->get();
    }
}
