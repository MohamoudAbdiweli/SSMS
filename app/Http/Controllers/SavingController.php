<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SavingCreatedMail;
use Illuminate\Support\Facades\Mail;

class SavingController extends Controller
{
    /**
     * Show all savings
     */
    public function index()
    {
        $savings = Saving::with('user')->orderBy('created_at', 'asc')->get();
        return view('savings.index', compact('savings'));
    }

    /**
     * Show form to create a new saving
     */
    public function create()
    {
        $users = User::all();
        return view('savings.create', compact('users'));
    }

    /**
     * Store new saving
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:regular,fixed,target',
            'target_amount' => 'nullable|numeric',
            'maturity_date' => 'nullable|date',
        ]);

        // Create saving
        $saving = Saving::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'target_amount' => $request->target_amount,
            'maturity_date' => $request->maturity_date,
            'status' => 'active',
        ]);

        // Generate receipt number and store
        $saving->update([
            'receipt_number' => 'SAV-' . str_pad($saving->id, 5, '0', STR_PAD_LEFT)
        ]);

        // Load user relationship
        $saving->load('user');

        // Send email with receipt
        Mail::to($saving->user->email)
            ->send(new SavingCreatedMail($saving));

        // Redirect to receipt page
        return redirect()->route('savings.index', $saving->id);
    }

    // Show edit form
    public function edit(Saving $saving)
    {
        $users = User::all(); // so you can select member
        return view('savings.edit', compact('saving', 'users'));
    }

    // Update saving
    public function update(Request $request, Saving $saving)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'target_amount' => 'nullable|numeric',
            'maturity_date' => 'nullable|date',
        ]);

        $saving->update([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'target_amount' => $request->target_amount,
            'maturity_date' => $request->maturity_date,
        ]);

        return redirect()->route('savings.index');
    }
    /**
     * Show receipt page
     */
    public function receipt($id)
    {
        $saving = Saving::with('user')->findOrFail($id);
        return view('savings.receipt', compact('saving'));
    }

    /**
     * Delete a saving
     */
    public function destroy(Saving $saving)
    {
        $saving->delete();
        return back();
    }
}
