<template>
    <div id="todo-list">
        <div class="task">
            <div class="newtask">
                
                <h1>New Task</h1>
                <input type="text" v-model="newTask.title" class="todo-name" placeholder="Add New Task...">
                <button @click="addTask()" class="btn">Add</button>
            </div>
        </div>
        <div class="todo">
            <div class="todo-task">
                <h1>To Do List</h1>
                <input type="text" v-model="search" placeholder="Search..." class="todo-search">
                <div v-for="(task) in tasks" :key="task.id" class="task-list">
                    <div class="task-name">
                        <input type="checkbox" v-model="task.is_completed" class="check-list" @click="updateTask(task.id)">
                        <input type="text" v-model="task.title" :disabled="inputDisabled" class="todo-name todo-item">
                        <button @click="removeTask(task.id)" class=" remove-btn">Remove</button>
                        <!-- <button @click="updateTask(task.id)" class=" remove-btn">Edit</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';

  export default {
    name: 'Todo',
    data() {
      return {
          newTask:{
            title:'',
        },
        search:'',
        tasks: [
            // {title: 'toan la', is_completed: false},
            // {title: 'olala', is_completed: false},
            // {title: 'toan', is_completed: false},
        ],
        
        isDone: false,
        inputDisabled: true,
      }
    },
    computed: {
        tasks: function() {
            return this.tasks.filter((task) => {
                return task.title.match(this.search);
            })
        }
    },
    methods: {
        addTask: function() {
          axios.post(`http://127.0.0.1:8000/api/todos`, this.newTask)
          .then(()=> {
            this.getTask();
            this.newTask.title = '';
        }).catch((e)=> {console.log(e)});
        },
        getTask: function() {
            axios.get(`http://127.0.0.1:8000/api/todos`)
            .then((resp) => {
                this.tasks = resp.data;        
            }).catch((e)=> {console.log(e)});
        },
        removeTask: function(id) {
            axios.delete(`http://127.0.0.1:8000/api/todos/` + id).then(() => {
                this.getTask();
            }).catch((e)=> {console.log(e)});
        },
        updateTask: function(id) {
            const newTask = this.tasks;
            newTask.is_completed = !newTask.is_completed;
            // newTask.title = newTask.title;
            axios.put(`http://127.0.0.1:8000/api/todos/` + id, {
                // title: newTask.title,
                is_completed: newTask.is_completed
            })
            .then((resp) => {
                this.tasks = this.tasks.map(task => {
                if (task.id === id) {
                    task.is_completed = !task.is_completed;
                    task.title = resp.data
                }

                return task;
                });
            }).catch((e)=> {console.log(e)});
        }
    },
    mounted: function () {
        this.getTask();
    },
    props: {
      msg: String
    }
  }
  </script>
  
  <style scoped>
    #todo-list {
        background-color: #fafafa;
        /* display: flex; */
        justify-content: center;
        box-sizing: border-box;
    }
    .task, .todo {
        display: inline-block;
        border: 1px solid #000;
    }

    .newtask {
        margin: 30px;
    }
    .todo-task {
        margin: 65px;
    }
    .newtask, .task-detail {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 600px;
    }

    .task-list {
        display: block;
        box-sizing: border-box;
    }
    .task-name {
        display: flex;
        align-items: center;
    }
    .done {
        text-decoration: line-through;
    }
    h1 {
        font-size: 50px;
    }
    .todo-name {
        width: calc(100%-8px);
        height: 40px;
        font-size: 20px;
    }

    .label-des {
        text-align: left;
        font-weight: 700;
        margin: 30px 0 10px 0;
    }

    .todo-des {
        width: calc(100%-6px);
        height: 200px;
        border: 1px solid #000;
    }

    .date-pri {
        display: flex;
        justify-content: space-between;
    }

    .due-date, .priority {
        display: flex;
        flex-direction: column;
        width: 275px;
    }

    .label-date {
        text-align: left;
        font-weight: 700;
        margin: 30px 0 10px 0;
    }

    .todo-date {
        width: 100%;
        height: 38px;
        border: 1px solid #000;
    }

    .label-priority {
        text-align: left;
        font-weight: 700;
        margin: 30px 0 10px 0;
    }

    .todo-priority {
        width: 100%;
        height: 40px;
        border: 1px solid #000;
    }
    .btn {
        display: block;
        font-size: 30px;
        padding: 10px;
        margin-top: 50px;
        width: 100%;
        border-radius: 4px;
        border: none;
        color: #fff;
        background-color: #5cb85c;
    }

    .btn:hover {
        cursor: pointer;
    } 

    .todo-search {
        width: 646px;
        height: 40px;
        font-size: 20px;
    }
    .task-name {
        margin: 20px 20px 0 20px;
        border: 1px solid #000;
        width: 650px;
        height: 100px;
    }

    .task-detail {
        border: 1px solid #000;
        border-top: none;
        margin: 0 0 20px 20px;
        padding: 25px;
    }

    .bulk-action {
        position: absolute;
        top: auto;
        width: 600px;
        bottom: 30px;
        background-color: #BBB;
    }

    .bulk-action-detail {
        position: relative;
    }
    .check-list {
        width: 20px;
        height: 20px;
    }
    div .todo-item {
        font-size: 30px;
        border: none;
        width: 40%;
    }
    .edit-btn, .remove-btn {
        font-size: 30px;
    }
  </style>