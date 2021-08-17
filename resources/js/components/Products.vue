<template>
    <div>
        <form id="delete-products-form" action="/delete" method="post">
            <div class="products-container">
            <div class="product"  v-for="product in products" :key="product.id">
                <input type="checkbox" class="delete-checkbox" name="delete-checkbox[]" :value="product.id">
                <div class="product-property">{{product.sku}}</div>
                <div class="product-property">{{product.name}}</div>
                <div class="product-property">{{product.price}} $</div>
                <div class="product-property">{{product.property}}: {{product.property_value}}</div>
            </div>
            </div>
        </form>
    </div>
</template>

<script>
    const Axios = require('axios').default;
    export default {
        
        mounted()  {
            this.getProducts();
        },
        data: function() {
            return {
                products: []
            }
        },
        methods: {
            getProducts() {
                Axios.post('/', {})
                .then((response)=>{
                    let objects = response.data;
                    for (let object of objects)
                    {
                        this.products.push(object);
                    }
        }) }
        }
    }
  
</script>