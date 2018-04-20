<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Record request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('productrequest.store')}}" id="create_form">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="product" class="col-form-label text-md-right">{{ __('Product') }}</label>
                                <input id="product" type="text" class="form-control{{ $errors->has('product') ? ' is-invalid' : '' }}" name="product" value="{{ old('product') }}" required autofocus>

                                @if ($errors->has('product'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">



                            <div class="col-md-12">
                                <label for="customer" class="col-form-label text-md-right">{{ __('Customer') }}</label>
                                <select class="form-control {{ $errors->has('customer') ? ' is-invalid' : '' }}" id="customer" name="customer" required>
                                  @foreach(App\Customer::all() as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('customer'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('customer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="create_form" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
