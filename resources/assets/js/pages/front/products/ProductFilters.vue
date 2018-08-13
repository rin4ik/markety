 <template>
    <div class="row">
        <aside class="col side-left">
            <ul class="nav" v-if="catalog">
                <div class="form-group">

                    <li v-if="option.products.length > 0" v-for="option in catalog.category.manufacturers">
                        <label class="custom-control checkbox">
                            <input v-model="brandcheck" :value="option.id" type="checkbox">
                            <span> {{option.name}} ({{option.products.length}}) </span>
                        </label>
                    </li>
                    <li v-else>
                        <label :for="`man_${option.id}`" class="custom-control checkbox">
                            <input disabled :id="`man_${option.id}`" :name="`man_${option.id}`" type="checkbox">

                            <span> {{option.name}} ({{option.products.length}}) </span>
                        </label>
                    </li>
                </div>
                <div class="form-group" v-for="filter in filters">
                    <legend>{{filter.name}}</legend>
                    <ul>

                        <li v-if="filter.type == 'checkbox'" v-for="option in filter.options">
                            <label :for="`flt_${filter.id}_opt_${option[0]}`" class="custom-control checkbox">
                                <input :id="`flt_${filter.id}_opt_${option[0]}`" :name="`flt_${filter.id}_opt_${option[0]}`" type="checkbox">
                                <span> {{option[1]}}</span>
                            </label>
                        </li>
                        <li v-if="filter.type == 'radio'" v-for="option in filter.options">
                            <label :for="`flt_${filter.id}_opt_${option[0]}`" class="custom-control radio">
                                <input :id="`flt_${filter.id}_opt_${option[0]}`" :name="`flt_${filter.id}`" type="radio">
                                <span> {{option[1]}}</span>
                            </label>
                        </li>
                        <p v-if="filter.type == 'input'" v-for="option in filter.options">
                            <input type="text" :value="option[0]"> {{option[1]}}
                        </p>
                    </ul>

                </div>
            </ul>
        </aside>
        <main class="col main" role="main">
            <ul class="products-list">
                <li class="product" v-for="product in prods">
                    <a href="/product">
                        <div class="product-discont d-none">-10%</div>
                        <div class="product-image"><img src="/img/1.jpg" alt=""></div>
                        <div class="product-content">
                            <div class="product-price">
                                <span class="product-price-c">
                                    <span>от</span>250 000 с.</span>
                                <span class="product-price-o d-none">250 000 с.</span>
                            </div>
                            <div class="product-title">
                                {{product.id}} {{catalog.category.name}} {{product.manufacturer.name}} {{product.model}}
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </main>
        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchPosts()"></pagination>

    </div>
</template>
 
<script>
export default {
    props: ['catalog','filters','products'],
    data () {
        return {
            brandcheck:'',
            load:0,
            prods: this.products.data.data,
            pagination: this.products.pagination, 
        }
    }, 
    watch: {
        brandcheck () {
             let params = {
                    brands: this.brandcheck,
                    categoryId: this.catalog.category.id
                };  
                
            axios.get(`/catalog/${this.catalog.id}`, {params: params})
                .then((response) =>{ 
             this.$router.replace({ query: { "brands[]" : this.brandcheck }}) 
                    this.prods = response.data.data.data
                    this.pagination = response.data.pagination
                     return response.data
                })
           
         },
         
    },   
 mounted(){
    this.brandcheck = this.products.brands.brands ? this.products.brands.brands : []
 },
    methods: {  
        selectedBrands(id){ 
            var data = ''
            if(this.brandSelected){
                this.brandSelected.filter((value, key)=>{  
                if(value == id)
                { 
                    data = value
                }   
            }) 
        }
             
            if(data == id){
                console.log('somethin')
                return true
            }
            return false
            
        },
        fetchPosts() {
            let params = {
                    brands: this.brandcheck,
                    categoryId: this.catalog.category.id
                };
            axios.get(`/catalog/${this.catalog.id}?page=${this.pagination.current_page}`,{params: params})
                .then(response => {
             this.$router.replace({ query: { "page" : this.pagination.current_page }}) 
                    
                    this.prods = response.data.data.data;
                    this.pagination = response.data.pagination; 
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        // changeProducts (e) {  
        //     var brandId = e.target.value.split('_')  
        //     if(this.brandcheck.length > 0){
        //         this.brandcheck.map((value, key)=>{ 
        //             if(value == brandId[1]){  
        //                 this.brandcheck.splice(key,1) 
        //                 this.load = 2
        //             }
        //         }) 
        //     }  
        //     if(this.load != 2){
        //        this.brandcheck.push(brandId[1])
        //        this.load--                       
        //     }  
        //     this.load = 0
        // }
    }
}
</script>
