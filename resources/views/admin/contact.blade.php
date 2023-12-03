@extends('adminlte::page')

@section('title', 'Контакты')

@section('content_header')
    <div class="row d-flex justify-content-between col-md">
        <div>
            <h1>Контакты</h1>
        </div>
        <div>
            <x-adminlte-button label="Создать" theme="primary" data-toggle="modal" data-target="#modalCreate"
                               icon="fa fa-lg fa-fw fa-plus">
            </x-adminlte-button>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalCreate" title="Создание"
                              size='lg' v-centered static-backdrop scrollable>
                <form action="{{route('admin.contact.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">Тип</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="type"
                                   placeholder="Enter type">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Данные</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="data"
                                   placeholder="Enter data">
                        </label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                    <x-slot name="footerSlot"></x-slot>
                </form>
            </x-adminlte-modal>
        </div>
    </div>
@stop

@section('content')
    @php
        $heads = [
            'id',
            'Тип',
            'Данные',
      ];
    @endphp


    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable compressed beautify>
{{--        @if($contact)--}}
            @foreach($contact as $con)
                <tr>
                    <td>{{$con->id}}</td>
                    <td>{{$con->type}}</td>
                    <td>{{$con->data}}</td>
                    <td>
                        <x-adminlte-button theme="primary" data-toggle="modal" data-target="#modalEdit{{$con->id}}"
                                           icon="fa fa-lg fa-fw fa-pen"></x-adminlte-button>
                        <x-adminlte-button theme="danger" data-toggle="modal" data-target="#modalDelete{{$con->id}}"
                                           icon="fa fa-lg fa-fw fa-trash"></x-adminlte-button>
                        <x-adminlte-button data-toggle="modal" data-target="#modalShow{{$con->id}}"
                                           icon="fa fa-lg fa-fw fa-eye">
                        </x-adminlte-button>
                    </td>
                </tr>
                <x-adminlte-modal icon="fa fa-info-circle" id="modalShow{{$con->id}}" title="Контакт"
                                  size='lg' enctype="multipart/form-data" v-centered static-backdrop scrollable>
                    <div class="row">
                        <div class="col-md-6">ID</div>
                        <div class="col-md-6">{{$con->id}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Тип</div>
                        <div class="col-md-6">{{$con->type}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Данные</div>
                        <div class="col-md-6">{{$con->data}}</div>
                    </div>
                    <x-slot name="footerSlot"></x-slot>
                </x-adminlte-modal>
                <x-adminlte-modal theme="danger" icon="fa fa-lg fa-fw fa-trash" id="modalDelete{{$con->id}}"
                                  title="Удаление"
                                  v-centered static-backdrop scrollable>
                    Вы уверены?
                    <x-slot name="footerSlot">
                        <form action="{{ route('admin.contact.delete', ['id' => $con->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-adminlte-button theme="success" type="submit" label="Yes"/>
                        </form>
                        <x-adminlte-button label="No" data-dismiss="modal" theme="danger"/>
                    </x-slot>
                </x-adminlte-modal>
                <x-adminlte-modal theme="primary" icon="fa fa-lg fa-fw fa-pen" id="modalEdit{{$con->id}}"
                                  title="Редактирование" size="lg"
                                  v-centered static-backdrop scrollable>
                    <form action="{{route('admin.contact.update', ['id' => $con->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">Тип</div>
                            <label class="col-md-6">
                                <input class="form-control" type="text" name="type"
                                       placeholder="Enter type" value="{{$con->type}}">
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Данные</div>
                            <label class="col-md-6">
                                <input class="form-control" type="text" name="data"
                                       placeholder="Enter data" value="{{$con->data}}">
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                        <x-slot name="footerSlot"></x-slot>
                    </form>
                </x-adminlte-modal>
            @endforeach
{{--        @endif--}}
    </x-adminlte-datatable>
@endsection

