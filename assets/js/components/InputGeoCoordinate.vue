<template>
    <div v-bind:id="id">
        <input
                type="number"
                class=""
				:max="maxDegree"
				:min="-maxDegree"
                v-model.number="degree"
        />
        &nbsp;°&nbsp;
        <input
                type="number"
                class=""
				step="0.0001"
				max="59.9999"
				min="0"
                v-model.number="minutes"
        />'
		<input type="hidden" v-model="coordinate" :name="name" :id="id" />
		<div class="note">Note : {{Math.abs(degree)}}°{{minutes}}'{{coord_type==='lat'? (coordinate >= 0 ? "N" : "S") : (coordinate > 0 ? "E" : "O")}}</div>
    </div>
</template>

<script>
export default {
	name: "InputGeoCoordinate",
	props: {
            id: String,
			value: Number,
            name: String,
			required: Boolean,
			coord_type: {
				validator: function (value) {
					return ['lat', 'long'].indexOf(value) !== -1
		    	}
			}
        },
	data: function() {
		return {
			degree: Math.floor(this.value),
			minutes: (this.value - Math.floor(this.value))*60,
			maxDegree: this.coord_type=="lat"? 90 : 180,
			};
	},
	computed: {
		coordinate: function() {return ((this.degree)||0) + (isNaN(this.minutes)? 0 : this.minutes/60);},
		
	},
	methods: {
		update: function () {
			this.$emit('input', this.coordinate);
		}
	},
	watch: {
		degree: function() { this.$emit('input', this.coordinate); },
		minutes: function() { this.$emit('input', this.coordinate);},
	}
}
</script>

<style scoped lang="css">
 input {
	 width: auto;
	 max-width: 7em;
 }
 .note {
	 font-size: 0.8em;
	 color: #7F7F7F;
 }
</style>