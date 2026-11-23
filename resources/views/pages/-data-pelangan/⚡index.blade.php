<?php

use Livewire\Component;
use App\Models\tb_kec;
use Livewire\WithPagination;

new class extends Component
{

    use WithPagination;

    public string $nama='';
    public string $search = '';
    public $perPage = 5;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }



    public function simpan()
        {

            tb_kec::create([
                    'nama' => $this->nama,
                ]);
                $this->reset();
        }

    public function getTbKecProperty()
        {
            return tb_kec::query()
        ->when($this->search, function ($query) {

            $search = trim($this->search);

            $query->where(function ($q) use ($search) {
                $q->where('nik', $search)
                    ->orWhere('nkk', $search)
                    ->orWhere('nama', 'like', $search . '%');
            });

        })
        //->paginate(10);
        ->paginate($this->perPage);
        }



};
?>

<div>
    <div class="mb-4 flex justify-between items-center">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari Nama, NIK atau NKK..."
            class="w-full md:w-80 px-4 py-2 rounded-lg border border-gray-600 bg-gray-800 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >

        <flux:select wire:model.live="perPage" class="w-20 px-2">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </flux:select>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-700">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">NKK</th>
                    <th class="px-4 py-3">NIK</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Tempat Lahir</th>
                    <th class="px-4 py-3">Tanggal Lahir</th>
                    <th class="px-4 py-3">Status Kawin</th>
                    <th class="px-4 py-3">Kelamin</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Kecamatan</th>
                </tr>
            </thead>

            <tbody class="text-sm italic uppercase">
                @forelse($this->tb_kec as $item)
                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                        <td class="px-4 py-2">
                            {{ $this->tb_kec->firstItem() + $loop->index }}
                        </td>
                        <td class="px-2 py-2">{{ $item->nkk }}</td>
                        <td class="px-2 py-2">{{ $item->nik }}</td>
                        <td class="px-2 py-2">{{ $item->nama }}</td>
                        <td class="px-2 py-2 ">{{ $item->tempat_lahir }}</td>
                        <td class="px-2 py-2">{{ $item->tanggal_lahir }}</td>
                        <td class="px-2 py-2">{{ $item->sts_kawin }}</td>
                        <td class="px-2 py-2">{{ $item->kelamin }}</td>
                        <td class="px-2 py-2">{{ $item->alamat }}</td>
                        <td class="px-2 py-2">{{ $item->kecamatan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-6">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $this->tb_kec->links() }}
        </div>

    </div>

</div>
