<?php

use Livewire\Component;
use Livewire\withpagination;
use App\Models\Product;

new class extends Component {
    use WithPagination;
    public string $nama = '';
    public string $search = '';

    public ?int $deleteId = null;
    public bool $showDeleteModal = false;

    public function confirmDelete($id)
        {
            $this->deleteId = $id;
            $this->showDeleteModal = true;
        }

    public function simpan()
        {
            Product::create([
                'nama' => $this->nama,
            ]);
            $this->reset();
            $this->resetPage();
        }

    public function getProductsProperty()
        {
            return Product::query()
            ->where('nama', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(5);
        }

    public function updatedSearch()
        {
            $this->resetPage();
        }

    public function hapus($id)
        {
            //Product::findOrFail($id)->delete();
            Product::find($this->deleteId)?->delete();
            $this->showDeleteModal = false;
            $this->showDeletedModal = true;
        }
};
?>



<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs ">


    <div class="flex items-center justify-between mt-2 mb-4 gap-2">
        <flux:link
            :href="route('create')"
            wire:navigate
            class="no-underline! px-2 py-2 bg-transparent text-white rounded-lg hover:bg-blue-700 ">
            Tambah Data
        </flux:link>
        <div class="ml-auto w-95 px-4">
            <flux:input
            wire:model.live.debounce.300ms="search"
            icon="magnifying-glass"
            placeholder="Cari produk..."
        />
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-2">
            {{ session('success') }}
        </div>
    @endif



    <table class="w-full text-sm text-left text-body border border-gray-100">
        <thead class="text-sm text-body bg-neutral-secondary-soft uppercase ">
            <tr>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100 ">
                    no
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100 ">
                    nama
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100 ">
                    gambar products
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100">
                    stok
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100">
                    harga
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100">
                    status stok
                </th>
                <th scope="col" class="px-6 py-3 text-sm font-smaibold border border-gray-100">
                    aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->products as $product)
                <tr class="bg-neutral-primary border border-gray-100">

                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap  border border-gray-100">
                        {{ ($this->products->currentPage() - 1) * $this->products->perPage() + $loop->iteration }}
                    </td>


                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap  border border-gray-100">
                        {{ $product->nama }}
                    </td>
                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap  border border-gray-100">
                        @if($product->gambar)

                            <img
                                src="{{ asset('storage/'.$product->gambar) }}"
                                class="w-16 h-16 rounded object-cover"
                            >

                        @endif
                    </td>

                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap border border-gray-100">
                        {{ $product->stok }}
                    </td>
                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap border border-gray-100">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap  border border-gray-100">
                        @if($product->stok <= 5)

                            <span class="text-red-500">
                                {{ $product->stok }}
                            </span>
                        @else
                            <span class="text-green-500">
                                {{ $product->stok }}
                            </span>
                        @endif
                    </td>

                    <td class=" font-medium text-heading whitespace-nowrap border border-gray-100">

                        <div class="flex">
                            <div class="flex py-2 px-4 gap-4">
                                <flux:button icon="pencil" :href="route('products.edit', $product)" wire:navigate variant="ghost">
                                    Edit
                                </flux:button>


                                <flux:button icon="trash" variant="danger"
                                wire:click="confirmDelete({{ $product->id }})"
                                >
                                    Hapus
                                </flux:button>

                            </div>

                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $this->products->links() }}
    </div>
<flux:modal wire:model="showDeleteModal">

    <div class="space-y-4">

        <h2 class="text-lg font-bold text-red-500">
            Konfirmasi Hapus
        </h2>

        <p>
            Yakin data ini akan dihapus?
        </p>

        <div class="flex justify-end gap-2">

            <flux:button
                variant="ghost"
                wire:click="$set('showDeleteModal', false)"
            >
                Batal
            </flux:button>

            <flux:button
                variant="danger"
                //wire:click="hapus"
                wire:click="hapus({{ $product->id }})"
            >
                Ya, Hapus
            </flux:button>

        </div>

    </div>

</flux:modal>

</div>
