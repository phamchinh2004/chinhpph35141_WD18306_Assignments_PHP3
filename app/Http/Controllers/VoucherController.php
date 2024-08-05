<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::paginate(8);
        return view('app.admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'code' => ['required', 'max:255', 'string'],
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($request->input('type') == 'percent' && $value > 100) {
                    $fail('The amount must be less than or equal to 100 when the type is percent.');
                }
            }],
            'quantity' => ['required', 'numeric'],
            'image' => ['required', 'file'],
            'type' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'minimum_order_value' => ['required', 'numeric'],
        ]);
        if ($validate) {
            $voucherCheck = Voucher::where('code', $request->code)->first();
            if (!$voucherCheck) {
                $file = $request->image;
                $fileExt = $file->getClientOriginalExtension();
                $fileName = time() . '-voucher-' . random_int(10, 10000) . '.' . $fileExt;
                $file->move(public_path('uploads'), $fileName);
                $validate['image'] = $fileName;
                Voucher::create($validate);
                return redirect()->route('vouchersManagerIndex')->with('statusSuccess', 'New voucher added successfully!');
            } else {
                return back()->with('statusError', 'A voucher with the same code already exists');
            }
        }
        return back()->withErrors($validate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::find($id);
        if ($voucher) {
            return view('app.admin.voucher.edit', compact('voucher'));
        } else {
            return back()->with('statusError', 'Voucher information needed to be edited could not be found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'code' => ['required', 'max:255', 'string'],
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($request->input('type') == 'percent' && $value > 100) {
                    $fail('The amount must be less than or equal to 100 when the type is percent.');
                }
            }],
            'quantity' => ['required', 'numeric'],
            'image' => ['nullable', 'file'],
            'type' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'minimum_order_value' => ['required', 'numeric'],
        ]);
        if ($validate) {
            $voucherCheck = Voucher::where('code', $request->code)->where('id', '!=', $id)->first();
            if (!$voucherCheck) {
                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $fileExt = $file->getClientOriginalExtension();
                    $fileName = time() . '-voucher-' . random_int(10, 10000) . '.' . $fileExt;
                    $file->move(public_path('uploads'), $fileName);
                    $validate['image'] = $fileName;
                } else {
                    unset($validate['image']);
                }
                Voucher::where('id', $id)->update($validate);
                return redirect()->route('vouchersManagerIndex')->with('statusSuccess', 'Voucher update successfully!');
            } else {
                return back()->with('statusError', 'A voucher with the same code already exists');
            }
        }
        return back()->withErrors($validate);
    }
    public function updateStatus(String $voucher_id)
    {
        $voucher = Voucher::find($voucher_id);
        if ($voucher) {
            if ($voucher->is_active == 1) {
                $voucher->is_active = 2;
            } else {
                $voucher->is_active = 1;
            }
            $voucher->update();
            return back()->with('statusSuccess', 'Voucher updated successfully!');
        } else {
            return back()->with('statusError', 'No voucher found to update');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
