<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head', ['title' => 'Create Product'])
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-5.jpg" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            @include('layouts.sidebar', ['selected' => 'product'])
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.nav', ['title' => 'New product'])
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add a product</h4>
                                </div>
                                <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}">
                        @csrf

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
                                 <select class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required autofocus>
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
                               <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}">
                                   
                               </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       

                        <div class="form-group text-center">
                            <div >
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
    
</body>
<!--   Core JS Files   -->
@include('layouts.scripts')

</html>