<template>
    <div>
        <div class="container">
            <div class="header pt-3">
                <div class="d-flex justify-content-between">
                    <h2>Product add</h2>
                    <div class=buttons>
                        <button type="submit" name="delete-btn" class="btn btn-success mr-3" @click="saveProduct()">Save</button>
                        <a href="/" class="btn btn-danger">Cancel</a>
                    </div>
                </div> 
            </div>
            <hr>
            <div>
                <form id="product_form"  method="post">
                    <div class="d-flex justify-content-between form-field"><label for="sku">SKU</label><input id="sku" type="text" v-model="sku"></div>
                    <span v-if="saveClicked">{{ skuError}}</span>
                    <div class="d-flex justify-content-between form-field"><label for="name">Name</label><input id="name" type="text" v-model="name"></div>
                    <span v-if="saveClicked">{{ nameError}}</span>
                    <div class="d-flex justify-content-between form-field"><label for="price">Price</label><input id="price" type="number" v-model="price"></div>
                    <span v-if="saveClicked">{{ priceError}}</span>
                    <div class="d-flex justify-content-between form-field">
                        <label for="productType">Type switcher</label>
                        <select id="productType" v-model="selectedType">
                            <option value="0" disabled> Please select a product type</option>
                            <option value="DVD">DVD</option>
                            <option value="Book">Book</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                    <span v-if="saveClicked">{{ typeError}}</span>
                    <br>
                    <div v-if="selectedType == 'DVD'"><dvd-data :saveClicked="saveClicked" @changed="changeValues"></dvd-data></div>
                    <div v-if="selectedType == 'Furniture'"><furniture-data :saveClicked="saveClicked" @changed="changeValues"></furniture-data></div>
                    <div v-if="selectedType == 'Book'"><book-data :saveClicked="saveClicked" @changed="changeValues"></book-data></div>     
                </form>
            </div>
            <hr>
            <div class="footer"></div>
        </div>  
    </div>
</template>

<script>
    const Axios = require('axios').default;
    const PRODUCT_TYPES = ["DVD", "Book", "Furniture"];
    export default {
    
        
        data: function() {
            return {
                selectedType: '',
                sku: '',
                name: '',
                price: '',
                values: {"DVD": {"size":0}, "Furniture": {"height": 0, "width": 0, "length":0}, "Book": {"weight":0}},
                saveClicked: false
            }
        },
        computed: {
        isDisabled() {
            if (this.skuError || this.nameError || this.priceError || this.typeError) {
                return true;
            } 
            else {
                let properties = this.values[this.selectedType];
                for (let prop in properties) {
                    if (isNaN(properties[prop]) || properties[prop] <=0) {
                        return true;
                    }           
                }
                return false; 
            }
        },
        properties() {
            return {"DVD": {"property": "Size", "value": this.values["DVD"]["size"]},
            "Furniture": {"property": "Dimensions", "value": this.values["Furniture"]["height"] + "x" + this.values["Furniture"]["width"] + "x" + this.values["Furniture"]["length"]},
            "Book": {"property": "Weight", "value": this.values["Book"]["weight"]}};
        },
        nameError() {
            if (!this.name) return "Please, submit required data";
            else return "";
        },
        skuError() {
            if (!this.sku) return "Please, submit required data";
            else return "";
        },
        priceError() {
            if (!this.price) return "Please, submit required data";
            else if (isNaN(this.price)) return "Please, provide the data of indicated type";
            else return "";
        },
        typeError() {
            if (PRODUCT_TYPES.includes(this.selectedType)) return "";
            else return "Please, submit required data";
        }
        },
        methods: {
            saveProduct() {
                this.saveClicked = true;

                if (!this.isDisabled) {
                    const formData = new FormData();
                    formData.append('category', this.selectedType);
                    formData.append('sku', this.sku);
                    formData.append('name', this.name);
                    formData.append('price', this.price);
                    formData.append('property', this.properties[this.selectedType]["property"]);
                    formData.append('propertyValue', this.properties[this.selectedType]["value"]);

                    Axios.post('/add-product', formData).then((response)=>{
                        console.log(response);
                        if (response.status == 200) 
                        {
                            window.location.href = '/';
                        } 
                    })
                }
            },
            changeValues(values) {
                
                this.values[values[0]][values[1]] = values[2];
            },
            saved() {
                this.saveClicked=true;
            }
                
            

        }
    }
   
</script>