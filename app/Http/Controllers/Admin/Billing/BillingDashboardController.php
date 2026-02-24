<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use App\Models\Billing\Invoice;
use App\Models\Billing\Payment;
use App\Models\Billing\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingDashboardController extends Controller
{
    public function index()
    {
        Invoice::where('status', Invoice::STATUS_SENT)->where('due_date', '<', now()->startOfDay())->update(['status' => Invoice::STATUS_OVERDUE]);

        $totalInvoices = Invoice::count();
        $paidInvoices = Invoice::where('status', Invoice::STATUS_PAID)->count();
        $unpaidInvoices = Invoice::whereIn('status', [Invoice::STATUS_SENT, Invoice::STATUS_OVERDUE])->count();
        $draftInvoices = Invoice::where('status', Invoice::STATUS_DRAFT)->count();
        $revenue = (float) Payment::where('status', 'completed')->sum('amount');
        $overdueCount = Invoice::where('status', Invoice::STATUS_OVERDUE)->count();

        $recentInvoices = Invoice::with('client')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $recentPayments = Payment::with('invoice.client')
            ->orderByDesc('paid_at')
            ->limit(10)
            ->get();

        return view('admin.billing.dashboard', compact(
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'draftInvoices',
            'revenue',
            'overdueCount',
            'recentInvoices',
            'recentPayments'
        ));
    }
}
