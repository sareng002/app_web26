<?php

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;


new class extends Component {

    use WithFileUploads;
    public string $nama = '';
    public string $stok = '';
    public string $harga = '';
    public $gambar;
    public bool $showSuccessModal = false;

    public function kembali()
        {
            return $this->redirectRoute('products');
        }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $path = null;

        if ($this->gambar) {
            $path = $this->gambar->store(
                'products',
                'public'
            );
        }

        Product::create([
            'nama' => $this->nama,
            'stok' => $this->stok,
            'harga' => $this->harga,
            'gambar' => $path,
        ]);

        $this->showSuccessModal = true;

    }
};

?>

<div>
    <div class="max-w-2xl min-h-0 space-y-4 ">



        @if($gambar)

            <img
                src="{{ $gambar->temporaryUrl() }}"
                class="w-32 h-32 object-cover rounded"
            >

        @endif

        <flux:input wire:model="nama" label="Nama Produk"/>

        <flux:input wire:model="stok" type="number" label="Stok"/>

        <flux:input wire:model="harga" type="number" label="Harga"/>

        <input type="file" wire:model="gambar"/>

        <div class="flex gap-4">
            <flux:button variant="subtle" wire:click="simpan">
                Simpan
            </flux:button>
        </div>


        <flux:modal wire:model="showSuccessModal">
            <div class="space-y-4">
                <h2 class="text-lg font-bold">
                    Berhasil
                </h2>

                <p>Data berhasil disimpan.</p>

                <div class="flex justify-end">
                    <flux:button
                        variant="primary"
                        //wire:click="$set('showSuccessModal', false)"
                        wire:click="kembali"
                    >
                        OK
                    </flux:button>
                </div>
            </div>
        </flux:modal>

    </div>

</div>
