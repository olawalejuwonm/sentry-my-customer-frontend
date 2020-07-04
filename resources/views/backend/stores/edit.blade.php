@extends('layout.base')
@section("custom_css")
    <link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop
    @section('content')
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <a href="/admin/view_store" class="btn btn-primary">Go Back</a>
                        </nav>
                        <h4 class="mt-2">Edit your store: {{ $store->store_name }}</h4>
                    </div>
                </div>

                <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                            <div class="card-body">
                                    <form action="{{ route('store.update', ['store' => $store->_id]) }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="store name">Store Name</label>
                                            <input type="text" name="store_name" value="{{ $store->store_name }}" class="form-control"  placeholder="XYZ Stores">
                                          </div>
                                          <input type="hidden" name="_method" value="PUT">
                                          <div class="form-group col-md-6">
                                            <label for="inputTagline">Tagline</label>
                                            <input type="text" class="form-control" name="tagline" value="{{ $store->tagline }}" id="inputTagline" placeholder="Your Perfect Stay One Click away....">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputPhoneNumber">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ $store->phone_number }}" placeholder="+1(234) 567-8907">
                                          </div>
                                        <div class="form-group col-md-6" >
                                            <label for="inputEmailAddress"> Email Address (optional) </label>
                                            <input type="email" class="form-control" name="email" value="{{ $store->email }}" placeholder="you@example.com">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress">Address</label>
                                          <input type="text" class="form-control" name="shop_address" value="{{ $store->shop_address }}"  placeholder="123 Abby Avenue">
                                        </div>

                                        <input value="Update Changes" class="btn btn-success" type="submit">
                                    </form>
                                </div>
                             </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
@endsection

@section("javascript")
   <script src="/backend/assets/build/js/intlTelInput.js"></script>
   <script>
   var input = document.querySelector("#phone");
   window.intlTelInput(input, {
       // any initialisation options go here
   });
   </script>    
@stop