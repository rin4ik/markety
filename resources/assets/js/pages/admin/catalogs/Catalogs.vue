<template>
  <div>
    <div class="toolbar d-flex justify-content-between">
      <aside class="form-row">
      </aside>
      <aside class="form-row">
        <div class="col-auto">
          <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#newCatalog">Добавить</button>
        </div>
      </aside>
    </div>
    <div class="page-body">
      <div class="page-body-inner">
        <ol class="dd-list" v-if="allCatalogs.length > 0">
          <catalog :all="all" :categories="categories" v-if="catalogs" :catalogs="allCatalogs"   v-for="(catalog,index) in allCatalogs" :key="index" :catalog="catalog" :index="index"></catalog>
        </ol>
        <h4 style="margin-left:20px" v-else>Нет доступных каталогов</h4>

      </div>
    </div>
    <AddCatalog :categories="categories" @push="addSub" :catalogs="all" :all="allCatalogs" @added="addCatalog"  />
   </div>
</template>

<script>
import AddCatalog from './AddCatalog' 
import Catalog from './Catalog'
export default {
    props: ['catalogs', 'categories', 'allcats'],
    data() {
        return {
            allCatalogs: this.catalogs,
            all: this.allcats
        }
    },
    components: {
        Catalog,
        AddCatalog
    },
    methods: {
        addCatalog(data) {
            data['children'] = data['descendants']
            this.allCatalogs.push(data)
        },
        addSub(catalog, catalogId, form) {
            location.reload()
            this.allCatalogs.map((data, index) => {
                if (data.id === catalogId) {
                    location.reload()
                    flash('Под каталог добавлена')
                    return;
                }
            });
        },
    }
}
</script> 