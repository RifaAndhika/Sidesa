@extends('layouts.app')

@section('content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
</div>

<div class="row">
        <div class="col">
                <div class="card shadow">
                      <div class="card-body">
                     <div style="overflow-x: auto;">
                        <table class=" table table-bordered table-hovered" style="min-width: 100%">
                            <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                    </tr>
                            </thead>
                            @if (count($users) < 1)
                                    <tbody>
                                            <tr>
                                                    <td colspan="11">
                                                             <p class=" pt-3 text-center">Tidak ada data</p>
                                                    </td>
                                            </tr>
                                    </tbody>
                            @else
                            <tbody>

                                    @foreach ( $users as $item)
                                    <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                    <div class="d-flex">
                                                            <button  type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $item->id }}">
                                                            <i class="fas fa-eraser"></i>
                                                            </button>
                                                    </div>
                                            </td>
                                    </tr>
                                    @include('pages.resident.confirmation-delete')
                                    @endforeach
                            </tbody>
                            @endif
                           </table>
                  </div>
                     </div>

                </div>
        </div>
</div>

@endsection
