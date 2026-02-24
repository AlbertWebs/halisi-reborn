@extends('admin.layouts.admin')

@section('title', 'New Invoice')
@section('page-title', 'New Invoice')
@section('breadcrumb', 'Billing / Invoices / Create')

@section('content')
    <form method="POST" action="{{ route('admin.billing.invoices.store') }}" id="invoice-form" class="max-w-4xl">
        @csrf
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client *</label>
                    <select id="client_id" name="client_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[var(--color-forest-green)]">
                        <option value="">Select client</option>
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}" {{ (string) (old('client_id') ?? $preselectedClientId ?? '') === (string) $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->email }})</option>
                        @endforeach
                    </select>
                    @error('client_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="issue_date" class="block text-sm font-medium text-gray-700 mb-1">Issue Date *</label>
                        <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date *</label>
                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900">Line Items</h3>
                    <button type="button" id="add-row" class="text-sm text-[var(--color-forest-green)] hover:underline">+ Add line</button>
                </div>
                <table class="min-w-full" id="items-table">
                    <thead>
                        <tr class="text-left text-xs text-gray-500 uppercase">
                            <th class="pb-2 pr-2">Description</th>
                            <th class="pb-2 w-24">Qty</th>
                            <th class="pb-2 w-32">Unit</th>
                            <th class="pb-2 w-28">Unit Price</th>
                            <th class="pb-2 w-24 text-right">Total</th>
                            <th class="w-10"></th>
                        </tr>
                    </thead>
                    <tbody id="items-tbody">
                        <tr class="item-row">
                            <td class="pr-2"><input type="text" name="items[0][description]" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm" placeholder="Description"></td>
                            <td><input type="number" name="items[0][quantity]" step="0.01" min="0.01" value="1" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm item-qty"></td>
                            <td><input type="text" name="items[0][unit]" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm" placeholder="e.g. hr"></td>
                            <td><input type="number" name="items[0][unit_price]" step="0.01" min="0" value="0" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm item-price"></td>
                            <td class="text-right item-total text-sm font-medium">0.00</td>
                            <td><button type="button" class="remove-row text-red-600 hover:underline text-sm">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">
                <div>
                    <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-1">Tax rate (%)</label>
                    <input type="number" id="tax_rate" name="tax_rate" step="0.01" min="0" max="100" value="{{ old('tax_rate', 0) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>
                <div>
                    <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-1">Discount type</label>
                    <select id="discount_type" name="discount_type" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                        <option value="0" {{ old('discount_type', '0') === '0' ? 'selected' : '' }}>Fixed amount</option>
                        <option value="1" {{ old('discount_type') === '1' ? 'selected' : '' }}>Percentage</option>
                    </select>
                </div>
                <div>
                    <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-1">Discount value</label>
                    <input type="number" id="discount_value" name="discount_value" step="0.01" min="0" value="{{ old('discount_value', 0) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>
                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                    <select id="currency" name="currency" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-[var(--color-forest-green)]">
                        <option value="USD" {{ (string) (old('currency', 'USD')) === 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="KES" {{ (string) (old('currency', 'USD')) === 'KES' ? 'selected' : '' }}>KES</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea id="notes" name="notes" rows="2" class="w-full rounded-lg border border-gray-300 px-4 py-2">{{ old('notes') }}</textarea>
            </div>
            <div>
                <label for="payment_instructions" class="block text-sm font-medium text-gray-700 mb-1">Payment instructions</label>
                <textarea id="payment_instructions" name="payment_instructions" rows="2" class="w-full rounded-lg border border-gray-300 px-4 py-2" placeholder="e.g. Bank details, reference...">{{ old('payment_instructions') }}</textarea>
            </div>
        </div>
        <div class="mt-6 flex gap-4">
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 font-medium">Create Invoice</button>
            <a href="{{ route('admin.billing.invoices.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowIndex = 1;
            const tbody = document.getElementById('items-tbody');
            const addBtn = document.getElementById('add-row');

            function updateRowTotal(row) {
                const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
                const price = parseFloat(row.querySelector('.item-price').value) || 0;
                const total = (qty * price).toFixed(2);
                row.querySelector('.item-total').textContent = total;
            }

            function reindexRows() {
                tbody.querySelectorAll('.item-row').forEach((row, i) => {
                    row.querySelectorAll('input').forEach(inp => {
                        inp.name = inp.name.replace(/items\[\d+\]/, 'items[' + i + ']');
                    });
                });
            }

            tbody.addEventListener('input', function(e) {
                if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price')) {
                    updateRowTotal(e.target.closest('.item-row'));
                }
            });

            addBtn.addEventListener('click', function() {
                const row = document.createElement('tr');
                row.className = 'item-row';
                row.innerHTML = '<td class="pr-2"><input type="text" name="items[' + rowIndex + '][description]" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm" placeholder="Description"></td>' +
                    '<td><input type="number" name="items[' + rowIndex + '][quantity]" step="0.01" min="0.01" value="1" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm item-qty"></td>' +
                    '<td><input type="text" name="items[' + rowIndex + '][unit]" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm" placeholder="e.g. hr"></td>' +
                    '<td><input type="number" name="items[' + rowIndex + '][unit_price]" step="0.01" min="0" value="0" required class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm item-price"></td>' +
                    '<td class="text-right item-total text-sm font-medium">0.00</td>' +
                    '<td><button type="button" class="remove-row text-red-600 hover:underline text-sm">Remove</button></td>';
                tbody.appendChild(row);
                rowIndex++;
                row.querySelector('.remove-row').addEventListener('click', function() {
                    if (tbody.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                        reindexRows();
                    }
                });
            });

            tbody.querySelectorAll('.remove-row').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = btn.closest('.item-row');
                    if (tbody.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                        reindexRows();
                    }
                });
            });
        });
    </script>
@endsection
