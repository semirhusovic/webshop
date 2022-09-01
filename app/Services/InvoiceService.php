<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    public function createInvoice($order,$price)
    {
        Invoice::query()->create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'status_id'=> InvoiceStatus::UNPAID,
            'invoice_total' => $price,
        ]);
    }

    public function export($invoice)
    {
        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);
        return $pdf->download('invoice.pdf');
    }
}
