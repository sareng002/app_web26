<?php

use Livewire\Component;
use App\Models\product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component
{

    use WithFileUploads;

    //edit data
    public Product $product;
    public string $nama = '';
    public string $stok = '';
    public string $harga = '';
    public $gambar;

    public bool $showSuccessModal = false;

    public function kembali()
    {
        return $this->redirectRoute('products');
    }

    public function mount(Product $product)
        {
            $this->product = $product;

            $this->nama = $product->nama;
            $this->stok = $product->stok;
            $this->harga = $product->harga;
        }

    public function update()
    {

        $data = [
            'nama' => $this->nama,
            'stok' => $this->stok,
            'harga' => $this->harga,
        ];

        if ($this->gambar) {

            if ($this->product->gambar) {

                Storage::disk('public')->delete($this->product->gambar);
            }

            $data['gambar'] = $this->gambar->store('products', 'public');
        }

        $this->product->update($data);
        $this->showSuccessModal = true;

        }

};
?>

<div>
    <div class="max-w-2xl space-y-4">

        <flux:input wire:model="nama" label="Nama Produk"/>

        <flux:input wire:model="stok" type="number" label="Stok"/>

        <flux:input wire:model="harga" type="number" label="Harga"/>

        <input type="file" wire:model="gambar">

            <div class="flex gap-4">

                @if($gambar)

                    <img
                        src="{{ $gambar->temporaryUrl() }}"
                        class="w-32 h-32 object-cover rounded"
                    >

                @elseif($product->gambar)

                    <img
                        src="{{ asset('storage/'.$product->gambar) }}"
                        class="w-32 h-32 object-cover rounded"
                    >

                @endif

            </div>



            <flux:button
        variant="primary"
        wire:click="update"
    >
        Update Produk
    </flux:button>

    <flux:modal wire:model="showSuccessModal">
    <div class="space-y-4">
        <h2 class="text-lg font-bold">
            Berhasil
        </h2>

        <p>Data berhasil diupdate.</p>

        <flux:button
            variant="primary"
            wire:click="kembali"
        >
            OK
        </flux:button>
    </div>
</flux:modal>


    </div>
</div>
