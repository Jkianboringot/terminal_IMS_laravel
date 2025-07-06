<div>
    <x-slot:header>Purchase_payments</x-slot:header>
    <div class="row justify-content-center">
        <div class="col-md-6 col-4 ">
            <div class="card">
                <div class="card-header  bg-inv-primary text-inv-secondary border-0">
                    <h5>Set Date & Supplier</h5>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="mb-3">
                            <label for="" class="form-label">Date of Purchase_payment</label>
                            <input wire:model.live="purchase_payment.payment_time" type="datetime-local"
                              class="form-control" />
                            @error('purchase_payment.payment_time')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Supplier Search</label>
                            <input type="text" wire:model.live='supplierSearch' class="form-control" />
                            @error('purchase_payment.supplier_id')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <ul class="list-group mt-2 w-100">
                                @if ($supplierSearch != '')
                                    @foreach ($suppliers as $supplier)
                                        <x-supplier-payment-list-item :supplier="$supplier"
                                            :purchase_payment="$purchase_payment" />
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                      
  <div class="mb-3">
                            <label for="" class="form-label">Total Amount</label>
                            <input wire:model.live="purchase_payment.amount" type="number"
                               class="form-control" />
                            @error('purchase_payment.amount')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                  <hr>
                <div class="col-md-6 col-12">
                      <div class="mb-3">
                    <label for="" class="form-label">Purchase</label>
                    <select wire:model="selectedPurchaseId"
                        class="form-select"
                        name=""
                        id=""
                    >
                     @if ($purchase_payment->supplier)
                       @foreach ($purchase_payment->supplier->purchases as $purchase )
                         <option value="{{ $purchase->id }}">Purchase #{{ $purchase->id }} <br> Balance: PISO {{number_format( $purchase->total_balance) }}</option>
                        @endforeach
                     @endif
                      
                    </select>
                  </div>
                </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                            <label for="" class="form-label">Amount to Attach</label>
                            <input wire:model.live="amount" type="number"
                               class="form-control" />
                            @error('amount')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                  </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-8"></div>
        </div>
        </div>




        <!-- after this make the supplier id and product a drop down and search because its annoying just being able to searcjh -->