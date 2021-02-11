@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if ( session()->has('msg') && session()->has('status') )
                            <div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
                                {{session('msg')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endIf

                        @include('computer.modal.add')
                    </div>
                    <div class="box-body">

                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#computer-modal-add">
                                    Nueva Computadora
                                </button>
                            </div>

                            <div class="card-body">
                                <table id="computer-datatable" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Modelo</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Sistema Operativo</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Imagen</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($computers as $computer)
                                            <tr>
                                                <td>{{ $computer->model }}</td>
                                                <td>{{ $computer->brand->name }}</td>
                                                <td>{{ $computer->os->name }}</td>
                                                <td>{{ $computer->description }}</td>
                                                <td class="text-center"> <img src="{{env('APP_URL', '')}}/storage/app/computer/{{$computer->id}}.{{$computer->extension}}" class="img-fluid" width="40px" height="40px"> </td>
                                                <td class="text-center">
                                                <form class="form-horizontal" method="get" id="delete-computer" enctype="multipart/form-data" action="{{route('destroy-computer', '')}}/{{$computer->id}}" role="form">
                                                        @csrf
                                                        <div class="modal-footer">
                                                            <button type="button" onclick="confirmar()" id="delete-computer-button" class="submit-form btn btn-danger">Eliminar</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('script')
    <script type="text/javascript">
        function confirmar(){
            swal({
                title: "¿Estás seguro de eliminar esta computadora?",
                text: "Una vez eliminado, no podrás recuperar la información ",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete){
                    document.getElementById('delete-computer').submit();
                }
            });
        }
    </script>
@endpush

@endsection
