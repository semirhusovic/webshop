<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    private $invoiceService;
    public function __construct(InvoiceService $service)
    {
        $this->invoiceService = $service;
    }

    public function downloadPdf(Invoice $invoice)
    {
        return $this->invoiceService->export($invoice);
    }
}
