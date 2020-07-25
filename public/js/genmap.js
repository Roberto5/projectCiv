class genmap {
	step=0;
	map=[];
	maptemp=[];
	dim=100;
	nArea=6;
	defaultArea=0;
	groundRate=0.5;
	complete=false;
	constructor(option) {
		var defaults={
			dim:100,
			nArea:6,
			defaultArea:0,
			groundRate:0.5
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
		var temp=[];
		switch (this.step) {
			case 0: 
				for (var x=0;x<this.map.length;x++) {
					temp[x]=[];
					for (var y=0;y<this.map[x].length;y++) 
					temp[x][y]=this.random(0,100)<=this.groundRate ? 1 :0 ;
				}
			break;
		}
		this.maptemp=temp;
		console.log(temp);
		var i=0;
		var tile=$('.tile');
		for (var x=0;x<temp.length;x++) 
			for (var y=0;y<temp[x].length;y++) {
				tile.eq(i).removeClass(function(i,name) {return name.match(/area-\d/g).join(' ');}).addClass('area-'+temp[x][y]);
				i++;
			}
		this.complete=true;
	}
	next() {
		if (this.complete) {this.step++;this.complete=false;this.map=this.maptemp;}
		return this.step;
	}
};