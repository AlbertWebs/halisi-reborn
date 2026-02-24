<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query()->withCount('invoices');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%");
            });
        }

        $clients = $query->orderBy('name')->paginate(20)->withQueryString();
        return view('admin.billing.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.billing.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:2000',
        ]);

        Client::create($validated);
        return redirect()->route('admin.billing.clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $client->load(['invoices' => fn ($q) => $q->orderByDesc('created_at')]);
        return view('admin.billing.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('admin.billing.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:2000',
        ]);

        $client->update($validated);
        return redirect()->route('admin.billing.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        if ($client->invoices()->count() > 0) {
            return redirect()->route('admin.billing.clients.index')->with('error', 'Cannot delete client with existing invoices.');
        }
        $client->delete();
        return redirect()->route('admin.billing.clients.index')->with('success', 'Client deleted successfully.');
    }
}
