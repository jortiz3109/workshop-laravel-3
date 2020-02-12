<div class="card-body">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <p-input
                rules="required|min:2|max:80"
                name="name"
                id="name"
                type="text"
                label="{{ __('fields.name.label') }}"
                initial-value="{{ old('name', $product->name) }}"
                @error('name')
                error="{{ $message }}"
                @enderror
                autocomplete="off"
            ></p-input>
        </div>
        <div class="form-group col-md-12">
            <p-input
                rules="required|numeric"
                name="price"
                id="price"
                type="number"
                label="{{ __('fields.price.label') }}"
                initial-value="{{ old('price', $product->priceAmount()) }}"
                @error('price')
                error="{{ $message }}"
                @enderror
                autocomplete="off"
            ></p-input>
        </div>
    </div>
</div>
