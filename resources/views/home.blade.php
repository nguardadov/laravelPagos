@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make a Payment</div>

                <div class="card-body">
                    <form action="{{route('pay')}}" method="POST" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="">How much you want to pay?</label>
                                <input 
                                    type="number"
                                    min="5"
                                    step="0.01" 
                                    class="form-control"
                                    name="value"
                                    value="{{mt_rand(500, 100000)/100}}"
                                    required
                                    >
                                <small class="form-text text-muted">
                                    Use Values with up to two decimal positions,
                                    Using dot "."
                                </small>
                            </div>
                            <div class="col-auto">
                                <label for="">Currency</label>
                                <select class="custom-select" name="currency" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->iso}}">{{strtoupper($currency->iso)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Select the desired payment platform:</label>
                                <div class="form-group" id="toggler">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @foreach ($paymentPlatforms as $paymentPlatform)
                                        <label class="btn btn-outline-secondary rounded m-2 p-1" 
                                            data-target="#{{$paymentPlatform->name}}Collapse"
                                            data-toggle="collapse"
                                        >
                                            <input 
                                                    type="radio" 
                                                    name="payment_platform" 
                                                    value="{{$paymentPlatform->id}}"
                                                    required
                                                    >
                                                <img class="img-thumbnail" src="{{asset($paymentPlatform->image)}}" alt="">
                                            </label>
                                        @endforeach
                                    </div>
                                     @foreach ($paymentPlatforms as $paymentPlatform)
                                       <div id="{{$paymentPlatform->name}}Collapse" class="collapse" data-parent="#toggler">
                                            @includeIf('components.'.strtolower($paymentPlatform->name).'-collapse')
                                       </div>
                                     @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" id="payButton" class="btn btn-primary btnl-lg">Pay</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
