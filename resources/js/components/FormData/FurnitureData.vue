<template>
<div>
    <div class="d-flex justify-content-between form-field">
        <label for="height">Height (CM)</label>
        <input id="height" type="number" min="0" v-model="values.height" @change="onChange('height')">
    </div>
    <span v-if="saveClicked">{{ heightError }}</span>
    <div class="d-flex justify-content-between form-field">
        <label for="width">Width (CM))</label>
        <input id="width" type="number" min="0" v-model="values.width" @change="onChange('width')">
    </div>
    <span v-if="saveClicked">{{ widthError }}</span>
    <div class="d-flex justify-content-between form-field">
        <label for="length">Length (CM)</label>
        <input id="length" type="number" min="0" v-model="values.length" @change="onChange('length')">
    </div>
    <span v-if="saveClicked">{{ lengthError }}</span>
    <div>Please, provide dimensions</div>
</div>

</template>

<script>
    export default {
        
        mounted()  {
        },
        props: ['saveClicked'],
        data: function() {
            return {
                values: {"height": 0, "width": 0, "length":0}
            }
        },
        methods: {
            onChange(prop) {
                this.$emit('changed', ["Furniture" , prop, this.values[prop]]);
            }
        },
        computed: {
            heightError() {
                if (!this.values['height']) return "Please, submit required data";
                else if (isNaN(this.values['height'])) return "Please, provide the data of indicated type";
                else return "";
            },
            widthError() {
                if (!this.values['width']) return "Please, submit required data";
                else if (isNaN(this.values['width'])) return "Please, provide the data of indicated type";
                else return "";
            },
            lengthError() {
                if (!this.values['length']) return "Please, submit required data";
                else if (isNaN(this.values['length'])) return "Please, provide the data of indicated type";
                else return "";
            },

        },
        beforeDestroy()  {
            
            this.values.height = this.values.width = this.values.length = 0;
            this.onChange("height");
            this.onChange("width");
            this.onChange("length");

        }
    }
   
</script>