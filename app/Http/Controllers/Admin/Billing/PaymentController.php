<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Payment;
use App\Models\Billing\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['invoice.client']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->invoice_id);
        }

        $payments = $query->orderByDesc('paid_at')->orderByDesc('created_at')->paginate(20)->withQueryString();
        return view('admin.billing.payments.index', compact('payments'));
    }
}
