<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Privecy;
use Illuminate\Http\Request;


class PrivecyController extends Controller
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
            $privecy = Privecy::where('type', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $privecy = Privecy::latest()->paginate($perPage);
        }
        return view('privecy.index', compact('privecy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('privecy.create');
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
        
         $request->validate([
         'type'=>'required|unique:privecies,type',
         'description'=>'required',
         'status'=>'required'
       ]);
        $requestData = $request->all();
        Privecy::create($requestData);
        return redirect('privecy')->with('success', 'Privecy  policy added!');
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
        $privecy = Privecy::findOrFail($id);

        return view('privecy.show', compact('privecy'));
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
        $privecy = Privecy::findOrFail($id);

        return view('privecy.edit', compact('privecy'));
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
        
         $request->validate([
         'type'=>'required|unique:privecies,type',
         'description'=>'required',
         'status'=>'required'
       ]);
         
        $requestData = $request->all();
        
        $privecy = Privecy::findOrFail($id);
        $privecy->update($requestData);

        return redirect('privecy')->with('success', 'Privecy policy updated!');
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
        Privecy::destroy($id);

        return redirect('privecy')->with('success', 'Privecy  policy deleted!');
    }
}
