<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProductCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $code, $name, $quantity, $price, $description, $productId;
    public $image;
    public $isEdit = false;
    public $isCreate = false;
    public $showMode = false;

    protected $rules = [
        'code' => 'required',
        'name' => 'required',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.product-crud', [
            'products' => Product::latest()->paginate(10),
        ]);
    }

    public function resetInputFields()
    {
        $this->code = '';
        $this->name = '';
        $this->quantity = '';
        $this->price = '';
        $this->description = '';
        $this->productId = null;
        $this->isEdit = false;
        $this->isCreate = false;
        $this->showMode = false;
    }

    public function showCreateForm()
    {
        $this->resetInputFields();
        $this->isCreate = true;
    }

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'code' => $this->code,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'New product is added successfully.');
        $this->resetInputFields();
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->image = $product->image;
        $this->showMode = true;
        $this->isEdit = false;
        $this->isCreate = false;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->image = $product->image;
        $this->isEdit = true;
        $this->isCreate = false;
        $this->showMode = false;
    }

    public function update()
    {
        $this->validate();
        $product = Product::findOrFail($this->productId);

        // Handle image update
        $imagePath = $product->image; // Default to old image
        if ($this->image && !is_string($this->image)) {
            // If a new image is uploaded
            $imagePath = $this->image->store('products', 'public');
        }

        $product->update([
            'code' => $this->code,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
        ]);
        session()->flash('success', 'Product is updated successfully.');
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('success', 'Product is deleted successfully.');
    }
}