<template>
  <div class="project-details-page" v-if="project">
    <div class="project-header">
      <h1>{{ project.name }}</h1>
      <p>{{ project.description }}</p>
    </div>

    <div class="tasks-section">
      <h2>Tasks</h2>
      <ul class="task-list">
        <li v-for="task in tasks" :key="task.id" class="task-item">
          <div>
            <strong>{{ task.name }}</strong> - {{ task.description }} ({{ task.status }})
          </div>
          <div class="task-actions">
            <button class="edit-button btn" @click="editTask(task)">Edit</button>
            <button class="delete-button btn" @click="deleteTask(task.id)">Delete</button>
          </div>
        </li>
      </ul>

      <div class="add-task-form">
        <h3>Add New Task</h3>
        <input v-model="newTask.name" placeholder="Task name" />
        <input v-model="newTask.description" placeholder="Task description" />
        <select v-model="newTask.status">
          <option disabled value="">Select Status</option> <!-- Placeholder -->
          <option value="todo">To Do</option>
          <option value="in-progress">In Progress</option>
          <option value="done">Done</option>
        </select>
        <button @click="addTask">Add Task</button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  props: {
    id: {
      type: [String, Number],
      required: true,
    },
  },
  data() {
    return {
      project: null,
      tasks: [],
      newTask: {
        name: '',
        description: '',
        status: '',
      },
    };
  },
  mounted() {
    this.getProjectDetails(this.id);
    this.getProjectTasks(this.id);
  },
  watch: {
    id(newId) {
      this.getProjectDetails(newId);
      this.getProjectTasks(newId);
    },
  },
  methods: {
    async getProjectDetails(id) {
      try {
        const response = await api.get(`/projects/${id}`);
        this.project = response.data;
      } catch (error) {
        console.error('Error fetching project details:', error);
      }
    },
    async getProjectTasks(id) {
      try {
        const response = await api.get(`/projects/${id}/tasks`);
        this.tasks = response.data;
      } catch (error) {
        console.error('Error fetching project tasks:', error);
      }
    },
    async addTask() {
      if (this.newTask.name && this.newTask.description && this.newTask.status) {
        try {
          const taskData = {
            ...this.newTask,
            project_id: this.id, // Ensure the project ID is passed to associate the task
          };
          const response = await api.post(`/tasks`, taskData);
          this.tasks.push(response.data);
          this.newTask = { name: '', description: '', status: '' };
        } catch (error) {
          console.error('Error adding task:', error);
        }
      } else {
        alert('Please fill all fields');
      }
    },
    async deleteTask(taskId) {
      try {
        await api.delete(`/tasks/${taskId}`);
        this.tasks = this.tasks.filter((task) => task.id !== taskId);
      } catch (error) {
        console.error('Error deleting task:', error);
      }
    },
    editTask(task) {
      console.log('Edit task', task);
    },
  },
};
</script>
<style scoped>
.project-details-page {
  padding: 20px;
}

.project-header {
  margin-bottom: 40px;
}

.project-header h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

.project-header p {
  font-size: 1.2rem;
  color: #666;
}

.tasks-section {
  margin-bottom: 40px;
}

.task-list {
  list-style: none;
  padding: 0;
}

.task-item {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
}

.task-actions button {
  margin-left: 10px;
}

.add-task-form {
  margin-top: 20px;
}

.add-task-form input {
  display: block;
  margin: 10px 0;
  padding: 8px;
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.add-task-form button {
  padding: 10px 20px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.add-task-form button:hover {
  background-color: #218838;
}

.btn {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 16px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  text-decoration: none;
  transition: background-color 0.3s;
}

.edit-button {
  background-color: #7ee696;
  color: white;
}

.edit-button:hover {
  background-color: #106d15;
}

.delete-button {
  background-color: #df2144;
  color: white;
}

.delete-button:hover {
  background-color: #61051e;
}

/* Basic styling for the select dropdown */
select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f9f9f9;
  color: #333;
  appearance: none; /* Remove default arrow for custom styling */
  outline: none;
  transition: border-color 0.3s ease, background-color 0.3s ease;
}

/* Add some space for a custom arrow (optional) */
select:focus {
  border-color: #007bff; /* Blue border on focus */
  background-color: #fff; /* White background on focus */
}

/* Hover effect */
select:hover {
  border-color: #007bff;
}

/* Add custom arrow icon for dropdown */
select::after {
  content: '\25BC'; /* Down arrow */
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

/* Optional: style the select options */
option {
  background-color: #fff;
  color: #333;
  padding: 10px;
}

/* Optional: Disabled option styles */
option[disabled] {
  color: #999;
}

</style>