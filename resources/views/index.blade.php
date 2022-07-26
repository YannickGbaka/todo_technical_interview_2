@extends('partials.main')

@section('content')
    <section class="vh-100" style="background-color: #eee;">
        <div x-data="todo" class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">
                    <div class="card">

                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2 mx-2"></i>Liste tâches à accomplir</h5>
                        </div>
                        @if (Session::has('task_creation'))
                            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                                <strong>Tâche crée 🎉</strong> {{ Session::get('task_creation') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('task_updating'))
                            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                                <strong>Tâche mise à jour 🎉</strong> {{ Session::get('task_updating') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('task_deleted'))
                            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                                <strong>Suppression de la tâche 🗑️</strong> {{ Session::get('task_deleted') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Tâche</th>
                                        <th scope="col">Priorité</th>
                                        <th scope="col">Etat</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($todos as $todo)
                                        <tr class="fw-normal">

                                            <td class="align-middle ">
                                                <form action="{{ route('todos.change_state') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary"
                                                        @if ($todo->state == true) checked @endif aria-label="...">
                                                        <i class="fa-solid fa-check-double text-success"></i>
                                                    </button>
                                                    @if ($todo->state == true)
                                                        <s>{{ $todo->task }}</s>
                                                    @else
                                                        <span>{{ $todo->task }}</span>
                                                    @endif
                                                    <input type="hidden" name="task_id" value="{{ $todo->id }}">
                                                </form>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="mb-0">
                                                    <span
                                                        class="badge badge-pill 
                                                    @switch($todo->priority) @case('Elévé')
                                                badge-danger
                                                @break

                                                @case('Moyenne')
                                                badge-warning
                                                @break

                                                @case('Faible')
                                                badge-info
                                                        @break @endswitch">
                                                        {{ $todo->priority }}
                                                    </span>
                                                </h6>
                                            </td>
                                            <td class="align-middle">
                                                @if ($todo->state == true)
                                                    <i class="fas fa-check text-success me-3"></i>
                                                @else
                                                    <i class="fas fa fa-spinner text-warning me-3"></i>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <form method="POST" class="inline-block"
                                                    action="{{ route('todos.delete', $todo->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#!" data-toggle="modal" data-task="{{ $todo->task }}"
                                                        data-priority="{{ $todo->priority }}"
                                                        data-state="{{ $todo->state }}"
                                                        data-task_id="{{ $todo->id }}" data-target="#modifyTodoModal"
                                                        class="btn updateTodo" title="Done"><i
                                                            class="fas fa-edit text-primary "></i></a>
                                                    <button type="submit" title="Remove" class="btn"><i
                                                            class="fas fa-trash-alt text-warning"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-end p-3">
                            <button @click="fetch" class="btn btn-primary" data-toggle="modal"
                                data-target="#addTodoModal">Ajouter
                                une tâche</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('partials.add_todo_modal')
    @include('partials.modify_todo_modal')
@endsection


@section('footer')
    <div class="text-center">
        Build with &hearts; by Gosse Yannick Cyriaque GBAKA
    </div>
@endsection
