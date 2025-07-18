<div>
    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Show Mode --}}
    @if (!empty($showMode) && $showMode)
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Product Information</span>
                        <button class="btn btn-primary btn-sm" wire:click="resetInputFields">&larr; Back</button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Code:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $code }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $name }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Quantity:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $quantity }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Price:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $price }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $description }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                @if ($image)
                                    @if (is_string($image))
                                        <img src="{{ asset('storage/'.$image) }}" width="120">
                                    @else
                                        <img src="{{ $image->temporaryUrl() }}" width="120">
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- Edit Mode --}}
    @elseif (!empty($isEdit) && $isEdit)
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Edit Product</span>
                        <button class="btn btn-primary btn-sm" wire:click="resetInputFields">&larr; Back</button>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            <div class="mb-3 row">
                                <label for="code" class="col-md-4 col-form-label text-md-end text-start">Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" class="form-control @error('code') is-invalid @enderror" wire:model="code">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-end text-start">Quantity</label>
                                <div class="col-md-6">
                                    <input type="number" id="quantity" class="form-control @error('quantity') is-invalid @enderror" wire:model="quantity">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="col-md-4 col-form-label text-md-end text-start">Price</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.01" id="price" class="form-control @error('price') is-invalid @enderror" wire:model="price">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="image" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($image)
                                        @if (is_string($image))
                                            <img src="{{ asset('storage/'.$image) }}" width="120">
                                        @else
                                            <img src="{{ $image->temporaryUrl() }}" width="120">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- Create Mode --}}
    @elseif (!empty($isCreate) && $isCreate)
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Add New Product</span>
                        <button class="btn btn-primary btn-sm" wire:click="resetInputFields">&larr; Back</button>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="mb-3 row">
                                <label for="code" class="col-md-4 col-form-label text-md-end text-start">Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" class="form-control @error('code') is-invalid @enderror" wire:model="code">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-end text-start">Quantity</label>
                                <div class="col-md-6">
                                    <input type="number" id="quantity" class="form-control @error('quantity') is-invalid @enderror" wire:model="quantity">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="col-md-4 col-form-label text-md-end text-start">Price</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.01" id="price" class="form-control @error('price') is-invalid @enderror" wire:model="price">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="image" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($image)
                                        @if (is_string($image))
                                            <img src="{{ asset('storage/'.$image) }}" width="120">
                                        @else
                                            <img src="{{ $image->temporaryUrl() }}" width="120">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- Index/List Mode --}}
    @else
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product List</div>
                    <div class="card-body">
                        <button class="btn btn-success btn-sm my-2" wire:click="showCreateForm">
                            <i class="bi bi-plus-circle"></i> Add New Product
                        </button>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">S#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('storage/'.$product->image) }}" width="60">
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" wire:click="show({{ $product->id }})">
                                                <i class="bi bi-eye"></i> Show
                                            </button>
                                            <button class="btn btn-primary btn-sm" wire:click="edit({{ $product->id }})">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm" wire:click="destroy({{ $product->id }})" onclick="return confirm('Do you want to delete this product?');">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <span class="text-danger">
                                                <strong>No Product Found!</strong>
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>