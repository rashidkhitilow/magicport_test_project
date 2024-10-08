<template>
  <div class="projects-page">
    <h1 class="page-title">Projects</h1>
    <input v-model="searchQuery" placeholder="Search projects..." class="search-bar" />

    <div class="projects-grid">
      <div v-for="project in filteredProjects" :key="project.id" class="project-card">
        <h2>{{ project.name }}</h2>
        <p>{{ project.description }}</p>
        <router-link :to="{ name: 'ProjectDetail', params: { id: project.id }}" class="view-button btn">
          View Details
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>

import api from '@/services/api';
export default {
  data() {
    return {
      projects: [],
      searchQuery: '',
    };
  },
  computed: {
    filteredProjects() {
      if (this.searchQuery.trim() === '') {
        return this.projects;
      }

      return this.projects.filter(project =>
          project.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  mounted() {
    this.getProjects();
  },
  methods: {
    async getProjects() {
      try {
        const response = await api.get('/projects');
        this.projects = response.data;
      } catch (error) {
        console.error('Error fetching projects:', error);
      }
    },
  },
};
</script>

<style scoped>
.projects-page {
  padding: 20px;
}

.page-title {
  text-align: center;
  font-size: 2rem;
  margin-bottom: 20px;
}

.search-bar {
  display: block;
  margin: 0 auto 20px;
  padding: 10px;
  width: 60%;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
}

.project-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.2s;
}

.project-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
.view-button {
  background-color: #007bff;
  color: white;
}

.view-button:hover {
  background-color: #0056b3;
}
</style>
