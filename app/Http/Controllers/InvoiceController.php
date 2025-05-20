<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\DeleteMultipleInvoiceRequest;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends BaseController
{
    public function index()
    {
        $invoices = Invoice::all();

        return $this->sendResponse(
            InvoiceResource::collection($invoices),
            'Invoices retrieved successfully.'
        );
    }

    public function store(StoreInvoiceRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice = Invoice::create($input);

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice created successfully.'
        );
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);

        if (is_null($invoice)) {
            return $this->sendError('Invoice not found.');
        }

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice retrieved successfully.'
        );
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice->update($input);

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice updated successfully.'
        );
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return $this->sendResponse([], 'Invoice deleted successfully.');
    }

    public function destroyMultiple(DeleteMultipleInvoiceRequest $request)
    {
        $ids = explode(',', $request->ids);

        Invoice::whereIn('id', $ids)->delete();

        return $this->sendResponse([], 'Invoices deleted successfully.');
    }
}
