<div x-data="todo" class="modal fade" id="modifyTodoModal" tabindex="-1" aria-labelledby="modifyTodoModalLabel"
    aria-hidden="true">
    <template
        x-on:modal.window="task = $event.detail.task; priority = $event.detail.priority; state = $event.detail.state; task_id = $event.detail.id">
    </template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyTodoModalLabel">Modification tâche</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('todos.update') }}">
                    @csrf
                    @method('PUT')
                    <label for="task" class="col-form-label">Tâche:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-rectangle-list text-info"></i>
                            </div>
                        </div>
                        <input type="text" name="task" x-model="task" required class="form-control"
                            id="task_modified">
                    </div>
                    <label for="priority" class="col-form-label">Priorité:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-scale-unbalanced-flip text-warning"></i>
                            </div>
                        </div>
                        <select x-model="priority" required class="form-control" name="priority" id="priority_modified">
                            <option :selected="priority == 'Elévé'" value="1">Elévé</option>
                            <option :selected="priority == 'Moyenne'" value="2">Moyenne</option>
                            <option :selected="priority == 'Faible'" value="3">Faible</option>
                        </select>
                    </div>
                    <label for="priority" class="col-form-label">Etat:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa-solid fa-spinner text-success"></i>
                            </div>
                        </div>
                        <select x-model="state" required class="form-control" name="state" id="state_modified">
                            <option :selected="state == 'Terminé'" value="1">Terminé</option>
                            <option :selected="state == 'En cours'" value="0">En cours</option>
                        </select>
                    </div>
                    <input type="hidden" name="task_id" id="task_id" x-model="task_id">
                    <div class="modal-footer">
                        <button @click.prevent="updateTodo()" class="btn btn-primary">
                            Modifer
                            <i class="fas fa-edit"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
