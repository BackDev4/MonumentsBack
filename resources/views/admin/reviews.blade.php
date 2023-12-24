@extends('adminlte::page')

@section('title', 'Отзывы')

@section('content_header')
    <div class="row d-flex justify-content-between col-md">
        <div>
            <h1>Отзывы</h1>
        </div>
        <div>
            <x-adminlte-button label="Создать" theme="primary" data-toggle="modal" data-target="#modalCreate"
                               icon="fa fa-lg fa-fw fa-plus">
            </x-adminlte-button>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalCreate" title="Создание"
                              size='lg' v-centered static-backdrop scrollable>
                <form action="{{route('admin.reviews.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">Имя</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="name"
                                   placeholder="Enter name">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Сообщение</div>
                        <div class="editor">
                            <textarea name="content"></textarea>
                        </div>
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
            'Имя',
            'Сообщение',
      ];
    @endphp


    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable compressed beautify>
        {{--        @if($contact)--}}
        @foreach($reviews as $rev)
            <tr>
                <td>{{$rev->id}}</td>
                <td>{{$rev->name}}</td>
                <td>{{$rev->content}}</td>
                <td>
                    <x-adminlte-button theme="primary" data-toggle="modal" data-target="#modalEdit{{$rev->id}}"
                                       icon="fa fa-lg fa-fw fa-pen"></x-adminlte-button>
                    <x-adminlte-button theme="danger" data-toggle="modal" data-target="#modalDelete{{$rev->id}}"
                                       icon="fa fa-lg fa-fw fa-trash"></x-adminlte-button>
                    <x-adminlte-button data-toggle="modal" data-target="#modalShow{{$rev->id}}"
                                       icon="fa fa-lg fa-fw fa-eye">
                    </x-adminlte-button>
                </td>
            </tr>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalShow{{$rev->id}}" title="Контакт"
                              size='lg' enctype="multipart/form-data" v-centered static-backdrop scrollable>
                <div class="row">
                    <div class="col-md-6">ID</div>
                    <div class="col-md-6">{{$rev->id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Имя</div>
                    <div class="col-md-6">{{$rev->name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Сообщение</div>
                    <div class="col-md-6">{{$rev->content}}</div>
                </div>
                <x-slot name="footerSlot"></x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="danger" icon="fa fa-lg fa-fw fa-trash" id="modalDelete{{$rev->id}}"
                              title="Удаление"
                              v-centered static-backdrop scrollable>
                Вы уверены?
                <x-slot name="footerSlot">
                    <form action="{{ route('admin.reviews.delete', ['id' => $rev->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-adminlte-button theme="success" type="submit" label="Да"/>
                    </form>
                    <x-adminlte-button label="Нет" data-dismiss="modal" theme="danger"/>
                </x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="primary" icon="fa fa-lg fa-fw fa-pen" id="modalEdit{{$rev->id}}"
                              title="Редактирование" size="lg"
                              v-centered static-backdrop scrollable>
                <form action="{{route('admin.reviews.update', ['id' => $rev->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">Имя</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="name"
                                   placeholder="Enter type" value="{{$rev->name}}">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Сообщение</div>
                        <div class="editor">
                            <textarea name="content">{{$rev->content}}</textarea>
                        </div>
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
    {{$reviews->links('pagination::bootstrap-4')}}
@endsection

