<template>
  <div>
    <div class="toolbar d-flex justify-content-between">
      <aside class="form-row">
      </aside>
      <aside class="form-row">
        <div class="col-auto">
          <button class="btn btn-sm btn-blue" type="button" data-toggle="modal" data-target="#newCategory">Добавить</button>
        </div>
      </aside>
    </div>
    <div class="page-body">
      <div class="page-body-inner">
        <ol class="dd-list">
          <category v-if="categories" :categories="allCategories" :all="all" v-for="(category,index) in allCategories" :key="index" :category="category" :index="index"></category>
        </ol>
      </div>
    </div>
    <add-category @push="addSub" :all="everyCat" @added="addCategory" :categories="allCategories"></add-category>
 <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
  </div>
</template>

<script>
import Category from './Category'
export default {
    props: ['categories', 'all'],
    data() {
        return {
            allCategories: this.categories,
            everyCat: this.all
        }
    },
    components: {
        Category
    },
    methods: {
        addCategory(data) {
            this.allCategories.push(data);
        },
        addSub(category, categoryId, form) {
            location.reload()
            this.allCategories.map((data, index) => {
                if (data.id === categoryId) {
                    location.reload()
                    flash('Под категория добавлена')
                    return;
                }
            });
        },
    }
}
</script> 