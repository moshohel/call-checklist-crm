@extends('call_checklist.app')

@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="invoice-wrapper rounded border bg-white py-5 px-3 px-md-4 px-lg-5">
            <div class="d-flex justify-content-between">
                <div>

                    <h4 class="text-dark font-weight-medium">Health, Happiness</h4>
                    <h4 class="text-dark font-weight-medium">and Dignity for all</h4>
                </div>
                <div class="btn-group">
                    <button class="btn btn-sm btn-secondary">
                        <i class="mdi mdi-content-save"></i> Save</button>
                    <button class="btn btn-sm btn-secondary">
                        <i class="mdi mdi-printer"></i> Print</button>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <h3 class="text-dark font-weight-medium" style="white-space: pre-line">SHOJON</h3>
            </div>
            <div class="d-flex justify-content-center">
                <p>A Telemental Health Service</p>
            </div>

            <div class="row pt-5 pb-5">
                <div class="col-xl-3 col-lg-4">
                    <p class="text-dark mb-2">Patient ID:</p>

                </div>
                <div class="col-xl-3 col-lg-4">
                    <p class="text-dark mb-2">Name:</p>

                </div>
                <div class="col-xl-3 col-lg-4">
                    <p class="text-dark mb-2">Age:</p>

                </div>
                <div class="col-xl-3 col-lg-4">
                    <p class="text-dark mb-2">Sex:</p>

                </div>
            </div>
            {{-- <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Platinum Support</td>
                        <td>1 year subcription 24/7</td>
                        <td>1</td>
                        <td>$3.999,00</td>
                        <td>$3.999,00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Custom Services</td>
                        <td>Instalation and Customization (cost per hour)</td>
                        <td>10</td>
                        <td>$250,00</td>
                        <td>$250,000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Origin License</td>
                        <td>Extended License</td>
                        <td>1</td>
                        <td>$799,00</td>
                        <td>$799,00</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Hosting</td>
                        <td>1 year subcription</td>
                        <td>1</td>
                        <td>$599,00</td>
                        <td>$599,00</td>
                    </tr>
                </tbody>
            </table> --}}

            <div class="row justify-content-start pt-5 pb-5">
                <div class="col-4">
                    <h6>Chief Compliant:</h6>
                    <h5>N\A</h5>
                </div>
            </div>

            <div class="row justify-content-start pt-5 pb-5">
                <div class="col-4">
                    <h6>M/S/E:</h6>
                    <h5>N\A</h5>
                </div>

                <div class="col-4">
                    <h6>Advice:</h6>
                    <h5>N\A</h5>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-lg-5 col-xl-4 col-xl-3 ml-sm-auto">
                    {{-- <ul class="list-unstyled mt-4">
                        <li class="mid pb-3 text-dark"> Subtotal
                            <span class="d-inline-block float-right text-default">$7.897,00</span>
                        </li>
                        <li class="mid pb-3 text-dark">Vat(10%)
                            <span class="d-inline-block float-right text-default">$789,70</span>
                        </li>
                        <li class="pb-3 text-dark">Total
                            <span class="d-inline-block float-right">$8.686,70</span>
                        </li>
                    </ul> --}}
                    <h6>DR. Name</h6>
                    <p>MBBS</p>
                    <h5>Dhaka Medical</h5>
                    <p>Address</p>
                    <a href="#" class="btn btn-block mt-2 btn-lg btn-primary btn-pill"> Procced</a>
                </div>
            </div>
        </div>
    </div>




</div>

@endsection