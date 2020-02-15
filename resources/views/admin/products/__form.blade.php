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
        <div class="form-group col-md-6">
            <p-input
                rules="required|alpha_num|min:6|max:6"
                name="code"
                id="code"
                type="text"
                label="{{ __('fields.code.label') }}"
                description="{{ __('fields.code.description') }}"
                initial-value="{{ old('code', $product->code) }}"
                @error('code')
                error="{{ $message }}"
                @enderror
                autocomplete="off"
            ></p-input>
        </div>
        <div class="form-group col-md-6">
            <p-input
                rules="required|numeric"
                name="price"
                id="price"
                type="number"
                label="{{ __('fields.price.label') }}"
                initial-value="{{ old('price', $product->price) }}"
                @error('price')
                error="{{ $message }}"
                @enderror
                autocomplete="off"
            ></p-input>
        </div>
        <div class="form-group col-md-12">
            <p-textarea
                rules="required|max:500"
                name="description"
                id="description"
                type="text"
                label="{{ __('fields.description.label') }}"
                initial-value="{{ old('description', $product->description) }}"
                @error('description')
                error="{{ $message }}"
                @enderror
                autocomplete="off"
            ></p-textarea>
        </div>
    </div>
</div>
