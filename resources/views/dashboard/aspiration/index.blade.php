@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Aspiration</h1>

    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive col-lg-8">

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tabel-aspiration">

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        const token = localStorage.getItem('token');
        $.ajax({
            url : "http://127.0.0.1:8000/api/aspiration",
            headers: {
                Authorization: `Bearer ${token}`,
            },
            method : "GET",
            dataType : "json",
            beforeSend : function() {
                let loader = true;
            },
            success : response => {
                let listAspiration = response.data
                let htmlString = ""
                for(let aspiration of listAspiration) {
                    htmlString += `
                    <tr>
                        <td>
                            <img src="${aspiration.photo}" width="200" height="200">
                        </td>
                        <td>${aspiration.name}</td>
                        <td>${aspiration.is_read ? 'Dibaca' : 'Belum Dibaca'}</td>
                        <td>
                            <a href="http://127.0.0.1:8000/dashboard/aspiration/detail/${aspiration.id}/?token=${token}">
                                <button>Detail</button></a>
                        </td>
                    </tr>`
                }
                let html = $.parseHTML(htmlString)
                $("#tabel-aspiration").append(html)
            }
        })

        function deleteAspiration($id) {
            $.ajax({
            url : `http://127.0.0.1:8000/api/aspiration/delete/${$id}`,
            headers: {
                Authorization: `Bearer ${token}`
            },
            method : "POST",
            dataType : "json",
            success : _ => {
                console.log("success");
                window.location.href="";
        },
        error: err => {
            console.log(err)
                }
            }
        )}
    </script>
@endsection
