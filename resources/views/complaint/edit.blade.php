<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="edit_form">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="form-group row">
                            

                           
                            <div class="col-md-12">
                                <label for="name" class="col-form-label text-md-right">{{ __('Name of product') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <div class="col-md-6">
                                <label for="brand" class="col-form-label text-md-right">{{ __('Brand/Manufacturer') }}</label>
                                <input id="brand" type="text" class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand" value="{{ old('brand') }}" required autofocus>

                                @if ($errors->has('brand'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Product category') }}</label>
                                 <select class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" id="type" required autofocus>
                                     <option value="Electronics, Computers & Office">Electronics, Computers & Office</option>
                                     <option value="Toys, Kids & Baby">Toys, Kids & Baby</option>
                                     <option value="Clothing, Shoes & Jewelry">Clothing, Shoes & Jewelry</option>
                                     <option value="Home, Garden & Tools">Home, Garden & Tools</option>
                                     <option value="Handmade products">Handmade products</option>
                                     <option value="Books">Books</option>
                                     <option value="Pet supplies">Pet supplies</option>
                                     <option value="Food & Grocery">Food & Grocery</option>
                                     <option value="Beauty & Health">Beauty & Health</option>
                                     <option value="Sports & Outdoors">Sport & Outdoors</option>
                                     <option value="Fashion">Fashion</option>
                                 </select>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                            

                            <div class="col-md-4">
                                <label for="quantity" class=" col-form-label text-md-right">{{ __('Quantity in stock') }}</label>
                                 <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity') }}" required>

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="size" class="col-form-label text-md-right">{{ __('Product size (optional)') }}</label>
                                 <input id="size" type="text" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}" name="size" value="{{ old('size') }}" >
                                @if ($errors->has('size'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="price" class=" col-form-label text-md-right">{{ __('Unit price') }}</label>
                                 <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right">{{ __('Product description (optional)') }}</label>
                               <textarea id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}">
                                   
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
        <button type="submit" form="edit_form" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>