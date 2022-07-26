<div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="addTodoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTodoModalLabel">Nouvelle tâche</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('todos.create') }}">
                    @csrf
                    <label for="task" class="col-form-label">Tâche:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-rectangle-list text-info"></i>
                            </div>
                        </div>
                        <input type="text" name="task" required class="form-control" id="task">
                    </div>
                    <label for="priority" class="col-form-label">Priorité:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-scale-unbalanced-flip text-warning"></i>
                            </div>
                        </div>
                        <select required class="form-control" name="priority" id="priority">
                            <option value="1">Elévé</option>
                            <option value="2">Moyenne</option>
                            <option value="3">Faible</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Créer
                            <i class="fa-solid fa-square-plus"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
