import axios from "axios";

export default ()=>({
    todos: [],
    
    init(){
        this.fetchTodos()
    },
    async fetchTodos(){
        const res = await axios.get('http://localhost:8000/api/todos');
        this.todos = res.data.data;
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
    }
});