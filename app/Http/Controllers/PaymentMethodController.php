<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $paymentMethod = $request->json()->all();
        $user_id = auth()->user()->id;
        return PaymentMethod::create([
            'ownerName' => $paymentMethod['ownerName'],
            'cardNumber' => $paymentMethod['cardNumber'],
            'expiryDate' => $paymentMethod['expiryDate'],
            'bank' => $paymentMethod['bank'],
            'user_id' => $user_id,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'ownerName' => 'sometimes|nullable',
            'cardNumber' => 'sometimes|nullable',
            'expiryDate' => 'sometimes', 'nullable',
            'bank' => 'sometimes|nullable',
        ]);

        $data = [];

        if ($request['ownerName']) {
            $data['ownerName'] = $request['ownerName'];
        }

        if ($request['cardNumber']) {
            $data['cardNumber'] = $request['cardNumber'];
        }

        if ($request->expiryDate) {
            $data['expiryDate'] = $request['expiryDate'];
        }

        if ($request->bank) {
            $data['bank'] = $request['bank'];
        }

        if (! empty($data)) {
            auth()->user()->paymentMethod->update($data);
        }

        return response()->json([
            'status' => true,
            'paymentMethod' => auth()->user()->paymentMethod,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        if(auth()->user()->paymentMethod != null){
            $user_payment_method = auth()->user()->paymentMethod->delete();
        }
        return response()->json([
            'status' => true,
        ]);
    }
}
