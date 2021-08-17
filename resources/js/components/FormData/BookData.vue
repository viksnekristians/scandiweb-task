<template>
<div>
    <div class="d-flex justify-content-between form-field">
        <label for="weight">Weight (KG))</label>
        <input id="weight" type="number" min="0" v-model="weight" @change="onChange()">
    </div>
    <span v-if="saveClicked">{{ weightError }}</span>
    <div>Please, provide weight</div>
</div>
</template>

<script>
    export default {
        
        mounted()  {
        },
        props: ['saveClicked'],
        data: function() {
            return {
                weight:0,
            }
        },
        methods: {
            onChange() {
                this.$emit('changed', ["Book" , "weight", this.weight]);
            }
        },
        computed: {
            weightError() {
                if (!this.weight) return "Please, submit required data";
                else if (isNaN(this.weight)) return "Please, provide the data of indicated type";
                else return "";
            }
        },
        beforeDestroy()  {
            this.weight = 0;
            this.onChange();
        }
    }
   
</script>