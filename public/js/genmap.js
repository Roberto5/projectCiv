class genmap {
	step=0;
	map=[];
	dim=100;
	nArea=6;
	defaultArea=0;
	constructor(option) {
		var defaults={
			dim:100,
			nArea:6,
			defaultArea:0
		};
		for (var key in defaults) {
			if (option.hasOwnProperty(key)) {
				this[key]=option[key];
			}
			else
				this[key]=defaults[key];
		}
		this.map=new Array(this.dim);
		var i;
		for (i=0;i<this.dim;i++) 
			this.map[i]=new Array(this.dim).fill(this.defaultArea);
	}
	random(min,max) {
		return Math.round(min+Math.random()*(max-min));
	}
	generate() {
		
		
		
		this.step++;
	}
	getStep() {
		return this.step;
	}
};