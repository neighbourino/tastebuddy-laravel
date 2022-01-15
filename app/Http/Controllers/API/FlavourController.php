<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flavour;
use Illuminate\Http\Request;

class FlavourController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $flavours = Flavour::query();

        if($request->has('query')) {
            $flavours->where('name', 'LIKE', '%'.$request->get('query').'%');
        }

        $flavours = $flavours->get();

        $flavours = $flavours->map(function ($item) {

            $item->pairings = $item->pairings();

            return $item;
        });

        return response()->json($flavours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $flavour = Flavour::findOrFail($id);


        $flavour->pairings = $flavour->pairings();

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        /*$flavour->name =
            (Flavour::find($flavour->primary_flavour_id)->getTranslation('name', $locale))
            . ' + ' .
            (Flavour::find($flavour->secondary_flavour_id)->getTranslation('name', $locale));*/

        return response()->json(
            $flavour
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
