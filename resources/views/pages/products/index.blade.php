<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component {
    public $nama = '';
    public $stok = '';
    public $harga = '';

    public function save()
    {
        Product::create([
            'nama' => $this->nama,
            'stok' => $this->stok,
            'harga' => $this->harga,
        ]);

        $this->reset();
    }

    public function getProductsProperty()
    {
        return Product::latest()->get();
    }
};

?>

<div class="space-y-4">

    <h1 class="text-2xl font-bold">
        Daftar Produk
    </h1>

    <flux:input wire:model="nama" label="Nama Produk" />

    <flux:input wire:model="stok" type="number" label="Stok" />

    <flux:input wire:model="harga" type="number" label="Harga" />

    <flux:button wire:click="save">
        Simpan
    </flux:button>

    <div class="mt-5">

        @foreach ($this->products as $product)
            <div class="border p-3 rounded mb-2">

                <strong>
                    {{ $product->nama }}
                </strong>

                <br>

                Stok :
                {{ $product->stok }}

                <br>

                Harga :
                Rp {{ number_format($product->harga) }}

            </div>
        @endforeach

    </div>

</div>
