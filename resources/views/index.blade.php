@extends('partials.main')

@section('content')
    <section x-data="todo" style="background-color: #eee;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">
                    <div class="card">

                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2 mx-2"></i>Liste tâches à accomplir</h5>
                        </div>

                        <div x-show="message.display == true" class="alert alert-success alert-dismissible fade show m-2"
                            role="alert">
                            <strong x-text="' 🎉 ' + message.content + ' 🎉' "></strong>
                            <button type="button" class="close" @click="message.display = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

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
                                    <template
                                        x-on:creating.window="
                                        todos = [...todos, $event.detail]; 
                                        message.type = 'success',
                                        message.display = true;
                                        message.content = 'La tâche a été crée avec succès'
                                        ">
                                    </template>
                                    <template
                                        x-on:updating.window="
                                        priority = $event.detail.priority;
                                        state = $event.detail.state 
                                        task = $event.detail.task; 
                                        task_id = $event.detail.id;
                                        updateTodoElement($event.detail); message.type='success' , message.display=true;
                                        message.content='La tâche a bien été mise à jour'">
                                    </template>
                                    <template x-for="todo
                                        in todos">
                                        <tr class="fw-normal">

                                            <td class="align-middle ">
                                                <form action="{{ route('todos.change_state') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary"
                                                        aria-label="...">
                                                        <i class="fa-solid fa-check-double text-success"></i>
                                                    </button>
                                                    <template x-if="todo.state == 'Terminé'">
                                                        <s x-text="todo.task"></s>
                                                    </template>
                                                    <template x-if="todo.state == 'En cours'">
                                                        <span x-text="todo.task"></span>
                                                    </template>
                                                    <input type="hidden" name="task_id" :value="todo.id">
                                                </form>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="mb-0">
                                                    <span class="badge badge-pill" :class="getPriorityBadge(todo.priority)"
                                                        x-text="todo.priority"></span>
                                                </h6>
                                            </td>
                                            <td class="align-middle">
                                                <i
                                                    :class=" todo.state == 'Terminé' ? 'fas fa-check text-success' :
                                                         'fas fa fa-spinner text-warning me-3'"></i>
                                            </td>
                                            <td class="align-middle">

                                                <a href="#!" data-toggle="modal" :data-task_id="todo.id"
                                                    data-target="#modifyTodoModal" class="btn updateTodo"
                                                    @click="$dispatch('modal', {...todo})" title="Done"><i
                                                        class="fas fa-edit text-primary "></i></a>
                                                <button type="submit" title="Remove" class="btn"><i
                                                        class="fas fa-trash-alt text-warning"></i></button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-end p-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addTodoModal">Ajouter
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
