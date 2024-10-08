<template>
  <div>
    <h1>Projects</h1>
    <ul>
      <li v-for="project in projects" :key="project.id">
        <router-link :to="`/projects/${project.id}`">{{ project.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  data() {
    return {
      projects: [],
    };
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

