import axios from "axios";

export default ()=>({
    todos: [],
    
    task_id: null,
    task: null,
    priority: null,
    state : null,
    search: '',

    task_create: null,
    priority_create: 1,

    
    message: {
        type: null,
        display : false,
        content: ''
    },

    init(){
        this.fetchTodos()
    },

    get filteredTodo() {
        return this.todos.filter(
            todo => todo.task.toLocaleLowerCase().includes(this.search.toLocaleLowerCase())
        )
    },
    
    async fetchTodos(){
        const res = await axios.get(`${Alpine.store('globalTask').appUrl}/api/todos`);
        this.todos = [... res.data.data];
    },


    async createTodo(){

        console.log(this.todos.length)

        const todo = {
            'task' : this.task_create,
            'priority' : this.priority_create,
            'state' : this.state,
        }
        const res = await axios.post(`${Alpine.store('globalTask').appUrl}/api/todos`, todo)
        if(res.status == 201 || res.status ==  200 ){
            $('#addTodoModal').modal('hide');
            const todoCreated = res.data.body
            todoCreated.state = todoCreated.state == 0 ? 'En cours' : 'Terminé'
            
            this.$dispatch('creating', todoCreated)
        }   

    },

    async updateTodo(){
        const todo = {
            'id' : this.task_id,
            'task' : this.task,
            'priority' :this.priority,
            'state' : this.state,
        }
        const res = await axios.put(`${Alpine.store('globalTask').appUrl}/api/todos/${this.task_id}`, todo)
        if(res.status == 201 || res.status ==  200 ){
            $('#modifyTodoModal').modal('hide');
            const todoUpdated = res.data.body
            todoUpdated.state = todoUpdated.state == 0 ? 'En cours' : 'Terminé'
    
            this.$dispatch('updating', todoUpdated)
        }
    },

    async deleteTodo(id){
        const res = await axios.delete(`${Alpine.store('globalTask').appUrl}/api/todos/${id}`)
        if(res.status == 201 || res.status ==  200 ){
            $('#modifyTodoModal').modal('hide');
            this.$dispatch('deleting', id)
        }
    },

    updateTodoElement(todo){
        let elementIndex = this.todos.findIndex(t => t.id == todo.id)
        this.todos[elementIndex] = todo
    },

    deleteTodoElement(id){
        let elementIndex = this.todos.findIndex(t => t.id == id)
        this.todos.splice(elementIndex, 1);
    },

    getPriorityBadge(priority){
        switch(priority){
            case 'Elévé':
                return 'badge-danger'
            
            case 'Moyenne':
                return 'badge-warning'
            
            case 'Faible':
            return 'badge-info'
        }
    },

    getPriority(priority){
        switch(priority){
            case 'Elévé' || 1:
                return 1;
            
            case 'Moyenne' || 2:
                return 2
            
            case 'Faible' || 3:
            return 3
        }
    },

    resetState(){
        this.task = null;
        this.priority = null;
        this.state = null;
    }

});