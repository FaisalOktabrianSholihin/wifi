<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::OrderByDesc('id')->paginate(10);
        return view('billing.index', compact('billings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Billing::create($validated);
        return to_route('super admin.billings.index')->with('message', 'Billings Created successfully.');
    }

    public function update(Request $request, $id)
    {
        $billings = Billing::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
        ]);
        $billings->update($validated);

        return redirect()->route('super admin.billings.index')->with('message', 'Permissions Updated successfully.');
    }

    public function destroy($id)
    {
        $billings = Billing::findOrFail($id);
        $billings->delete();

        return back()->with('message', 'Permission Deleted successfully');
    }
}
