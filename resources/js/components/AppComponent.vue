<template>
  <div>
    <ul class="list-group">
      <li class="list-group-item" v-for="item in data">
        <span class="badge badge-primary">#{{ item.id }}</span> {{ item.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'AppComponent',
  props: ['data'],
  mounted () {
    // Как-то обрабатываем данные
    console.log(this.data)
  }
}
</script>

<style scoped>

</style>