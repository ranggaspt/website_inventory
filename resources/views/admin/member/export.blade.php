<!DOCTYPE html>
<html lang="en">

<head>
    @section('judul', 'Admin | Laporan Data Pengguna')
</head>

<body>
    <div class="content ml-3 mr-3">
        <div>
            <h4 class="page-title">Laporan Data Pengguna</h4>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="dataTable" width="100%" cellspacing="0" border="0,5">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $member)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$member->user->name}}</td>
                                <td>{{$member->user->email}}</td>
                                <td>{{$member->phone}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
