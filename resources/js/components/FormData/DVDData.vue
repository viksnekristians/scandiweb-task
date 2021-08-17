<template>
<div>
    <div class="d-flex justify-content-between form-field">
        <label for="size">Size (MB)</label>
        <input id="size" type="number" min="0" v-model="size"  @change="onChange()">
    </div>
    <span v-if="saveClicked">{{ sizeError }}</span>
    <div>Please, provide size.</div>
</div>

</template>

<script>
    export default {
        
        props: ['saveClicked'],
        data: function() {
            return {
                size:0,
            }
        },
        methods: {
            onChange() {
                this.$emit('changed', ["DVD" , "size", this.size]);
            }
        },
        computed: {
            sizeError() {
                if (!this.size) return "Please, submit required data";
                else if (isNaN(this.size)) return "Please, provide the data of indicated type";
                else return "";
            }
        },
        beforeDestroy()  {
            
            this.size = 0;
            this.onChange();
        }
    }
   
</script>