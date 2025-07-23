<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-start gap-5">

                {{-- FORM INPUT --}}
                <div class="w-1/3 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold">
                        FORM INPUT DATA MAPEL
                    </div>
                    <form class="max-w-sm mx-5" method="POST" action="{{ route('mapel.store') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nama Mapel
                            </label>
                            <input type="text" name="nama" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                                   focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto 
                                   px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 
                                   dark:focus:ring-blue-800">
                            Submit
                        </button>
                    </form>
                </div>

                {{-- TABEL DATA --}}
                <div class="w-full bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold text-center">
                        DATA MATA PELAJARAN
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 
                                       dark:text-gray-400 text-center">
                                <tr>
                                    <th class="px-4 py-3 bg-gray-100">NO</th>
                                    <th class="px-6 py-3">NAMA MAPEL</th>
                                    <th class="px-6 py-3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nama as $index => $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                                        <th class="px-5 py-3 font-medium text-gray-900 bg-gray-100 dark:text-white">
                                            {{ ($nama->currentPage() - 1) * $nama->perPage() + $loop->iteration }}
                                        </th>
                                        <td class="px-5 py-3 bg-gray-100">
                                            {{ $item->nama }}
                                        </td>
                                        <td class="px-5 py-3 flex justify-center gap-2">
                                            <button type="button"
                                                class="bg-amber-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-amber-500"
                                                onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama }}">
                                                <i class="fi fi-sr-file-edit"></i>
                                            </button>
                                            <button type="button"
                                                class="bg-red-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                                onclick="return mapelDelete('{{ $item->id }}','{{ $item->nama }}')">
                                                <i class="fi fi-sr-delete-document"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $nama->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="sourceModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Update Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto flex items-center justify-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col p-4 space-y-6">
                        <div>
                            <label for="nis" class="block mb-2 text-sm font-medium text-gray-900">No</label>
                            <input type="text" id="nis" name="nis" class="form-input w-full" readonly />
                        </div>
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Mapel</label>
                            <input type="text" id="nama" name="nama" class="form-input w-full" required />
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-4 border-t border-gray-200 space-x-2">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 w-40 h-10 rounded-xl hover:bg-green-500 text-white">
                            Simpan
                        </button>
                        <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                            class="bg-red-500 w-40 h-10 rounded-xl text-white hover:bg-red-600">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->has('nama'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'NIP Duplikat!',
            text: '{{ $errors->first('nama') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('message_insert'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('message_insert') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if (session('message_update'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Diperbarui!',
            text: '{{ session('message_update') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<script>
    const editSourceModal = (button) => {
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const modal = document.getElementById('sourceModal');
        const form = document.getElementById('formSourceModal');

        document.getElementById('title_source').innerText = `Update Mata Pelajaran ${nama}`;
        document.getElementById('nama').value = nama;
        document.getElementById('nis').value = id;

        const url = "{{ route('mapel.update', ':id') }}".replace(':id', id);
        form.setAttribute('action', url);

        // Clear previous hidden _method inputs
        form.querySelectorAll('input[name="_method"]').forEach(e => e.remove());

        const methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PATCH');
        form.appendChild(methodInput);

        modal.classList.remove('hidden');
    }

    const sourceModalClose = (button) => {
        const modal = document.getElementById(button.dataset.modalTarget);
        modal.classList.add('hidden');
    }

    const mapelDelete = async (id, nama) => {
        Swal.fire({
            title: `Yakin ingin menghapus guru ${nama}?`,
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`/mapel/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: `Data guru ${nama} berhasil dihapus.`,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.'
                        });
                        console.error(error);
                    });
            }
        });
    }
</script>
