# Billing System

## Database schema

| Table | Purpose |
|-------|---------|
| `billing_clients` | Client name, email, phone, company, address, notes |
| `billing_invoices` | Invoice number, client_id, dates, subtotal, tax, discount, total, status (draft/sent/paid/overdue) |
| `billing_invoice_items` | Line items: description, quantity, unit, unit_price, total, sort_order |
| `billing_invoice_tokens` | Secure token per invoice for public payment link (non-guessable) |
| `billing_payments` | amount, payment_method, transaction_id, status, paid_at |

## Admin (role-based, behind `AdminMiddleware`)

- **Billing Dashboard** `GET /admin/billing` – Totals, recent invoices, recent payments.
- **Clients** `GET/POST /admin/billing/clients`, `GET/PUT/DELETE /admin/billing/clients/{client}` – CRUD.
- **Invoices** `GET/POST /admin/billing/invoices`, `GET/PUT/DELETE /admin/billing/invoices/{invoice}` – CRUD; draft-only edit/delete.
- **Invoice actions**  
  - `GET /admin/billing/invoices/{invoice}/pdf` – Download PDF.  
  - `POST /admin/billing/invoices/{invoice}/duplicate` – Duplicate as new draft.  
  - `POST /admin/billing/invoices/{invoice}/mark-sent` – Draft → Sent.  
  - `POST /admin/billing/invoices/{invoice}/payment-link` – Create/return token and show public URL.
- **Payments** `GET /admin/billing/payments` – List with optional status filter.

## Public (no login)

- **View invoice** `GET /billing/invoice/{token}` – Show invoice and amount due; token from `billing_invoice_tokens`.
- **Pay** `GET /billing/invoice/{token}/pay` – Redirect to Pesapal with order request.
- **Callback** `GET /billing/callback/{token}` – Pesapal return; verify status, record payment, mark invoice paid if full.
- **IPN** `GET /billing/ipn` – Pesapal IPN; verify and update payment/invoice (idempotent).
- **Download PDF** `GET /billing/invoice/{token}/pdf` – PDF for that token.

## Security

- **Signed / secure links**: Access by token only; token is long random string, optional `expires_at`.
- **Callback validation**: Status checked via Pesapal API; payment record updated only on success; duplicate payments avoided by checking existing transaction and status.
- **Role-based admin**: All billing admin routes use `AdminMiddleware`.

## Payment integration (Pesapal)

- Config: `config/pesapal.php` and `.env` (`PESAPAL_*`).
- Service: `App\Services\Billing\PesapalService` – register IPN, submit order request, get transaction status.
- Flow: Client clicks “Pay” → redirect to Pesapal → client pays → callback and/or IPN → we set payment completed and invoice to paid when total is covered.

## PDF generation

- Package: `barryvdh/laravel-dompdf`.
- Service: `App\Services\Billing\InvoicePdfService` – stream/download PDF from view `billing.pdf.invoice`.
- PDF includes company details from `SiteSetting`, client, line items, totals, notes, payment instructions.

## Example invoice design (PDF / public page)

- Header: Company name and contact (from settings).
- Bill to: Client name, email, phone, company, address.
- Table: Description, Qty, Unit price, Total.
- Totals: Subtotal, Tax, Discount, Grand total.
- Footer: Notes, payment instructions (if set).

## Env (add to `.env`)

```env
PESAPAL_ENVIRONMENT=sandbox
PESAPAL_CONSUMER_KEY=your_key
PESAPAL_CONSUMER_SECRET=your_secret
PESAPAL_CALLBACK_URL="${APP_URL}/billing/callback"
PESAPAL_IPN_URL="${APP_URL}/billing/ipn"
PESAPAL_IPN_ID=
```

Register the IPN URL with Pesapal once and set `PESAPAL_IPN_ID` if required by their flow.
