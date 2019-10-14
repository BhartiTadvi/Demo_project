<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manage_user_contact;
use Illuminate\Http\Request;
use App\Contactus;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseContactMail;

class manage_user_contactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $manage_user_contacts = Contactus::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address1', 'LIKE', "%$keyword%")
                ->orWhere('address2', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('zipcode', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $manage_user_contacts = Contactus::latest()->paginate($perPage);
        }
        return view('manage_user_contacts.index', compact('manage_user_contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manage_user_contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        manage_user_contact::create($requestData);
        return redirect()->route('manage_user_contacts.index')->with('flash_message', 'manage_user_contact added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $manage_user_contact = Contactus::findOrFail($id);
        return view('manage_user_contacts.show', compact('manage_user_contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $manage_user_contact = Contactus::findOrFail($id);
        return view('manage_user_contacts.edit', compact('manage_user_contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        $manage_user_contact = Contactus::findOrFail($id);
        $manage_user_contact->update($requestData);
         $responsemail= array(
        'name'  => $request->get('name'),
        'email'  => $request->get('email'),
        'subject'  => $request->get('subject'),
        'message' => $request->get('message'),
        'note' => $request->get('note'),
        'template_key' => "reply_email_template",
        );

        Mail::to($request['email'])->send(new ResponseContactMail($responsemail));
        return redirect()->route('manage_user_contacts.index')->with('flash_message', 'manage_user_contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Contactus::destroy($id);
        return redirect()->route('manage_user_contacts.index')->with('flash_message', 'manage_user_contact deleted!');
    }
}
