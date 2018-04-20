<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Record complaint</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('complaint.store')}}" id="create_form">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="title" class="col-form-label text-md-right">{{ __('Subject') }}</label>
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
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
                        <div class="form-group row">


                            <div class="col-md-12">
                                <label for="complaint" class="col-form-label text-md-right">{{ __('Complaint') }}</label>
                               <textarea id="complaint" class="form-control {{ $errors->has('complaint') ? ' is-invalid' : '' }}" name="complaint" value="{{ old('complaint') }}">

                               </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
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
